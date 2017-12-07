<?php
    require_once("constants.php");

    function redirect($destination) {
        header("Location: " . $destination);
    }

    function query(/* sql [, ....] */) {
        $sql = func_get_arg(0);

        $parameters = array_slice(func_get_args(), 1);

        static $handle;
        if(!isset($handle)) {
            try {
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            catch(Exception $e) {
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        $statement = $handle->prepare($sql);
        if($statement === false) {
            print("Some error.");
            exit;
        }
        
        $results = $statement->execute($parameters);

        if($results !== false) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            return false; 
        }
    }

    function render($template, $values = []) {
        if(file_exists("templates/$template")) {
            // extract variables into local scope
            extract($values);
            // render header
            require("templates/header.php");
            // render template
            require("templates/$template");
            // render footer
            require("templates/footer.php");
        }
        else {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }
    function in_render($template, $values = []) {
        if(file_exists("templates/$template")) {
            // extract variables into local scope
            extract($values);
            // render header
            require("templates/in_header.php");
            // render template
            require("templates/$template");
            // render footer
            require("templates/in_footer.php");
        }
        else {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

    function apologize($message) {
        render("apology.php", ["message" => $message]);
        exit;
    }

    function sanitize($str) {
        if(strlen($str) > 100) {
            apologize("What are you trying to do here?");
        }
        $hackfile = getcwd() . "/hackattempts/hackattempts.txt";
        $illegal = array('\'', '\<', '\;');
        for($i = 0; $i < count($illegal); $i++) {
            if(preg_match("/$illegal[$i]/", $str)) {
                if($fp = fopen($hackfile, "a")) {
                    fwrite($fp, $_SERVER['REMOTE_ADDR'] . " " . $str . "\n");
                    fclose($fp);
                }
                apologize("Hacking attempt. Your IP " . $_SERVER['REMOTE_ADDR'] . " was logged.");
            }
        }
    }

    function db_sanitize($str) {
        if(strlen($str) > 100) {
            echo "illegal";
            exit;
        }
        $illegal = array('\'', '\<', '\;');
        for($i = 0; $i < count($illegal); $i++) {
            if(preg_match("/$illegal[$i]/", $str)) {
                echo "illegal";
                //require_once("templates/startpage_error.php");
                exit;
            }
        }
    }

    function search_sanitize($stuff) {
        if(strlen($stuff) > 50) {
           echo_s_warning("What are you trying to do here?"); 
           exit;
        }

        $illegal = array('\@', '\|', '\/', '\&', '\'', '\~', '\*', '\+', '#', '\)', '\(', '\[', '\]', '\{', '\}', '\%', '\$', '\!', '\"', '\§', '\;', '\,', '\.', '\:', '\\\\', '\<', '\>', '\_', '\`', '\´', '\?', '\=', '\^');

        for($i = 0; $i < count($illegal); $i++) {
            if(preg_match("/$illegal[$i]/", $stuff)) {
                echo "illegal";
                //require_once("templates/startpage_error.php");
                exit;
            }
        }
    }

    function echo_s_warning($text) {
        echo '
            <script>
                searchWarning("' . $text .  '");
            </script>
        ';
    }

    function delete_sanitize($stuff) {
        if(strlen($stuff) > 50) {
           echo_s_warning("What are you trying to do here?"); 
           exit;
        }

        $illegal = array('\@', '\|', '\/', '\&', '\'', '\~', '\*', '\+', '#', '\[', '\]', '\{', '\}', '\%', '\$', '\!', '\"', '\§', '\;', '\,', '\.', '\:', '\\\\', '\<', '\>', '\_', '\`', '\´', '\?', '\=', '\^');

        for($i = 0; $i < count($illegal); $i++) {
            if(preg_match("/$illegal[$i]/", $stuff)) {
                echo "illegal";
                //require_once("templates/startpage_error.php");
                exit;
            }
        }
    }
    function logout() {
        $_SESSION = [];
        if(!empty($_COOKIE[session_name()])) {
            setcookie(session_name(), session_id(), time() - 42000);
        }
        session_destroy();
    }
?>
