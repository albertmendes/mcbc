    <p class="text-danger" id="search-warnings">&nbsp;</p>
    <form onsubmit="searchmcsh(); return false;" class="form-inline" role="search">
        <div class="form-group has-feedback has-feedback-left">
            <input id="mcsh-search-text" type="text" class="form-control mytooltip" placeholder="Search" />
            <i class="form-control-feedback glyphicon glyphicon-search"></i>
        </div>
        <select class="form-control" id="date-select">
            <option>Date</option>
            <option>This week</option>
            <option>Last week</option>
            <option>Past month</option>
            <option>2 months</option>
            <option>3 months</option>
            <option>6 months</option>
            <option>1 Year</option>
            <option>2 Years</option>
            <option>Pre 1980</option>
            <option>Pre 1970</option>
            <option>Pre 1960</option>
            <option>Pre 1950</option>
            <option>Pre 1940</option>
            <option>1990s</option>
            <option>1980s</option>
            <option>1970s</option>
            <option>1960s</option>
            <option>1950s</option>
            <option>1940s</option>
            <option>1996-2000</option>
            <option>1991-1995</option>
            <option>1986-1990</option>
            <option>1981-1985</option>
            <option>1976-1980</option>
            <option>1971-1975</option>
            <option>1966-1970</option>
            <option>1961-1965</option>
            <option>1956-1960</option>
            <option>1951-1955</option>
            <option>1946-1950</option>
            <option>1940-1945</option>
        </select>
        <input class="btn btn-warning mysubmitbutton" type="submit" />
    </form>

    <div id="search-results">
        <h1 class="searchingh1">Search</h1>
        <br />
        <p>
            Enter the description for the item of your desire in the search form above using the following syntax: <br />
            <code>Title issue</code> <br />
            For example<code>uncanny x-men 1</code>
            <br />
            while using only alphanumeric characters except of -. <br />
            <br />
            Your results will appear here.
        </p>
    </div>

