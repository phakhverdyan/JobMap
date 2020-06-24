<link rel="stylesheet" href="{{ asset('/css/fonts.css') }}">
<link rel="stylesheet" href="{{ asset('/libs/bootstrap4/css/bootstrap.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
body {
    margin: 0;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 20px;
    color: #333;
    background-color: #fff;
}

h4 {
    font-size: 18px;
    font-weight: bold;
}

h1, h2, h3, h4, h5, h6 {
    margin: 10px 0;
    font-family: inherit;
    font-weight: bold;
    line-height: 20px;
    color: inherit;
    text-rendering: optimizelegibility;
}
h1, h2, h3, h4, h5, h6 {
    font-weight: 500;
    color: #0067C8;
}
a, *[role=button] {
    text-decoration: none;
    cursor: pointer;
    color: #0067C8;
}
a:hover, a:focus {
    color: #005580;
    text-decoration: underline;
    text-decoration: none
}
h2 {
    font-size: 32px;
}
legend {
    display: block;
    width: 100%;
    padding: 0;
    margin-bottom: 20px;
    font-size: 21px;
    line-height: 40px;
    color: #333;
    border: 0;
    border-bottom: 1px solid #e5e5e5;
}
p {
    line-height: 1.4;
    color: #3e4552;
}
p.lead {
    font-size: 20px;
}
.d-flex {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
}
label {
    display: block;
    margin-bottom: 5px;
}
label, input, button, select, textarea {
    font-size: 14px;
    font-weight: normal;
    line-height: 20px;
}
textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
    border-radius: 1px;
    padding: 9px 9px;
    background-color: #fff;
    border: 1px solid #ccc;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    -webkit-transition: border linear 0.2s,box-shadow linear 0.2s;
    -webkit-transition: border linear 0.2s,-webkit-box-shadow linear 0.2s;
    transition: border linear 0.2s,-webkit-box-shadow linear 0.2s;
    transition: border linear 0.2s,box-shadow linear 0.2s;
    transition: border linear 0.2s,box-shadow linear 0.2s,-webkit-box-shadow linear 0.2s;
    font-size: 14px;
    line-height: 20px;
    color: #555;
    outline: none;
}
textarea:focus, textarea:active, input[type="text"]:focus, input[type="text"]:active, input[type="password"]:focus, input[type="password"]:active, input[type="datetime"]:focus, input[type="datetime"]:active, input[type="datetime-local"]:focus, input[type="datetime-local"]:active, input[type="date"]:focus, input[type="date"]:active, input[type="month"]:focus, input[type="month"]:active, input[type="time"]:focus, input[type="time"]:active, input[type="week"]:focus, input[type="week"]:active, input[type="number"]:focus, input[type="number"]:active, input[type="email"]:focus, input[type="email"]:active, input[type="url"]:focus, input[type="url"]:active, input[type="search"]:focus, input[type="search"]:active, input[type="tel"]:focus, input[type="tel"]:active, input[type="color"]:focus, input[type="color"]:active, .uneditable-input:focus, .uneditable-input:active {
    -webkit-box-shadow: none!important;
    box-shadow: none!important;
    border-color: #68a4da;
}
input[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly], textarea[readonly] {
    cursor: not-allowed;
    background-color: #eee;
}
select {
    height: 50px;
    padding-left: 9px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border: 1px solid #ddd;
    border-radius: 1px;
    padding-right: 20px;
    background-image: url("./img/select-bg.png");
    background-repeat: no-repeat;
    background-size: auto 11px;
    background-position: -webkit-calc(100% - 10px) center;
    background-position: calc(100% - 10px) center;
}
.row {
    margin: 0 25px!important;
}
.row:before, .row:after {
    display: table;
    content: "";
    line-height: 0;
}


.numbers {
    margin-top: 50px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap
}
.numbers .numberbox {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    margin-left: 90px;
    margin-right: 90px;
    width: 200px;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column
}
.numbers .numberbox .numberlabel {
    text-align: center
}
.numbers .bignumber {
    font-size: 81px;
    color: #1D75B7;
    padding-top: 30px;
    line-height: 81px;
    font-weight: 100;
    letter-spacing: 0.03em
}


/*--- Lists ---*/
.muted {
    color: #999;
}
a.muted:hover, a.muted:focus {
    color: gray;
}
.numberlabel {
    text-transform: uppercase;
    color: #787878;
    letter-spacing: 0.1em;
    margin-top: 15px;
    font-weight: 500;
    font-size: 15px;
    font-family: 'ProximaNova', 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
.stepbystep {
    position: initial;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    /* margin-left: 20px */
}
.stepbystep .active .numberlabel,
.stepbystep .active p {
    color: #1D75B7 !important
}
.stepbystep .active .number {
    background-color: #1D75B7;
    border: 1px solid transparent !important;
    color: white !important
}
.stepbystep .step {
    margin-top: 30px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    cursor: pointer
}

.stepbystep .step .stepnumber {
    color: #1D75B7;
    font-size: 15px;
    font-family: 'proxima-nova', 'Helvetica Neue', Helvetica, Arial, sans-serif
}
.stepbystep .step .number {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 1px solid #e1e1e1;
    padding-top: 2px
}
.step .steptext {
    margin-left: 30px;
    max-width: 330px
}
.step .steptext p {
    margin-top: 10px
}
.stepbystep .step .numberlabel {
    margin-top: 0px
}
.stepbystep .screenshots {
    padding: 30px
}
.featurecontent {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    max-width: 600px;
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap
}
.featurecontent .featurebox {
    margin: 0px 65px 50px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center
}
.featurecontent .featurebox img {
    max-width: 50px;
    max-height: 50px;
    padding-left: 20px
}
.featurecontent .featurebox p {
    width: 340px
}
.featurecontent .featurebox .featuretext {
    margin-left: 50px
}
.featurecontent .featurebox .numberlabel {
    margin-top: 0px;
    padding-bottom: 10px
}




/*--- Helpers ---*/
.formlabel {
    font-weight: 600;
    margin-bottom: 0px;
    line-height: 1.9em;
    color: #5a5f6d;
}
.border {
    border-bottom: 1px solid #f2f2f2;
    margin-bottom: 50px;
    margin-top: 10px;
}
.flex__flex-row {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
}
.flex__flex-column {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
}












/*--- Buttons ---*/
.btn {
    padding: 8px 20px 8px;
    border: 0;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-radius: 3px;
    text-shadow: none;
    font-weight: 500;
    box-shadow: none;
    font-size: 12px;
    -webkit-transition: 0.15s ease all;
    transition: 0.15s ease all
}

.btn {
    color: #263d52;
    background-image: -webkit-gradient(linear,left top,left bottom,from(#fff),to(#f7f9fb));
    background-image: -webkit-linear-gradient(#fff,#f7f9fb);
    background-image: linear-gradient(#fff,#f7f9fb);
    background-color: #f7f9fb;
    border: 1px solid #d4dce4;
    -webkit-transition: 0.15s ease all;
    transition: 0.15s ease all
}

.btn:hover {
    background: #f7f9fb;
    color: #444;
    -webkit-transition: 0.15s ease all;
    transition: 0.15s ease all
}

.btn:active,.btn:focus {
    background-position: 0 0;
    -webkit-box-shadow: none;
    box-shadow: none
}
.btn-primary {
    background-image: -webkit-gradient(linear,left top,left bottom,from(#3384c3),to(#2375b4));
    background-image: -webkit-linear-gradient(#3384c3,#2375b4);
    background-image: linear-gradient(#3384c3,#2375b4);
    background-color: #2b71b1;
    color: #fff;
    border-color: #2A68A5;
}
.btn-primary:hover {
    background: #2b71b1;
    color: #Fff;
}
.button__container {
    position: relative;
    width: auto;
    margin: 0px;
    border-radius: 4px;
    font-weight: 600;
    color: #FFFFFF;
    cursor: pointer;
    font-family: "Avenir Next", -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
    padding: 15px 25px;
    font-size: 16px;
}
.button__container-grey {
    border: 1px solid #DAE1E9;
    color: #9BA6B2;
    background-color: #FFFFFF;
}
.button__container-grey:hover {
    color: #4E5C6E;
    border: 1px solid #9BA6B2;
}
.button__container-blue {
    border: 1px solid #2E7BC4;
    background-color: #3C90DF;
}
.button__container-blue:hover {
    background-color: #2E7BC4;
    -webkit-transition: background-color ease 0.25s;
    transition: background-color ease 0.25s;
}
.button__content {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 100%;
    pointer-events: none;
}


/*--- Table ---*/

table {
    max-width: 100%;
    background-color: transparent;
    border-collapse: collapse;
    border-spacing: 0;
    font-size: 14px;
}

.table {
    width: 100%;
    margin-bottom: 20px
}

.table th,.table td {
    padding: 8px;
    line-height: 20px;
    text-align: left;
    vertical-align: top;
    border-top: 1px solid #ddd
}

.table th {
    font-weight: bold
}

.table thead th {
    vertical-align: bottom
}

.table caption+thead tr:first-child th,.table caption+thead tr:first-child td,.table colgroup+thead tr:first-child th,.table colgroup+thead tr:first-child td,.table thead:first-child tr:first-child th,.table thead:first-child tr:first-child td {
    border-top: 0
}

.table tbody+tbody {
    border-top: 2px solid #ddd
}

.table .table {
    background-color: #fff
}

.table-condensed th,.table-condensed td {
    padding: 4px 5px
}

.table-bordered {
    border: 1px solid #ddd;
    border-collapse: separate;
    *border-collapse: collapse;
    border-left: 0;
    border-radius: 4px
}

.table-bordered th,.table-bordered td {
    border-left: 1px solid #ddd
}

.table-bordered caption+thead tr:first-child th,.table-bordered caption+tbody tr:first-child th,.table-bordered caption+tbody tr:first-child td,.table-bordered colgroup+thead tr:first-child th,.table-bordered colgroup+tbody tr:first-child th,.table-bordered colgroup+tbody tr:first-child td,.table-bordered thead:first-child tr:first-child th,.table-bordered tbody:first-child tr:first-child th,.table-bordered tbody:first-child tr:first-child td {
    border-top: 0
}

.table-bordered thead:first-child tr:first-child>th:first-child,.table-bordered tbody:first-child tr:first-child>td:first-child,.table-bordered tbody:first-child tr:first-child>th:first-child {
    border-top-left-radius: 4px
}

.table-bordered thead:first-child tr:first-child>th:last-child,.table-bordered tbody:first-child tr:first-child>td:last-child,.table-bordered tbody:first-child tr:first-child>th:last-child {
    border-top-right-radius: 4px
}

.table-bordered thead:last-child tr:last-child>th:first-child,.table-bordered tbody:last-child tr:last-child>td:first-child,.table-bordered tbody:last-child tr:last-child>th:first-child,.table-bordered tfoot:last-child tr:last-child>td:first-child,.table-bordered tfoot:last-child tr:last-child>th:first-child {
    border-bottom-left-radius: 4px
}

.table-bordered thead:last-child tr:last-child>th:last-child,.table-bordered tbody:last-child tr:last-child>td:last-child,.table-bordered tbody:last-child tr:last-child>th:last-child,.table-bordered tfoot:last-child tr:last-child>td:last-child,.table-bordered tfoot:last-child tr:last-child>th:last-child {
    border-bottom-right-radius: 4px
}

.table-bordered tfoot+tbody:last-child tr:last-child td:first-child {
    border-bottom-left-radius: 0
}

.table-bordered tfoot+tbody:last-child tr:last-child td:last-child {
    border-bottom-right-radius: 0
}

.table-bordered caption+thead tr:first-child th:first-child,.table-bordered caption+tbody tr:first-child td:first-child,.table-bordered colgroup+thead tr:first-child th:first-child,.table-bordered colgroup+tbody tr:first-child td:first-child {
    border-top-left-radius: 4px
}

.table-bordered caption+thead tr:first-child th:last-child,.table-bordered caption+tbody tr:first-child td:last-child,.table-bordered colgroup+thead tr:first-child th:last-child,.table-bordered colgroup+tbody tr:first-child td:last-child {
    border-top-right-radius: 4px
}

.table-striped tbody>tr:nth-child(odd)>td,.table-striped tbody>tr:nth-child(odd)>th {
    background-color: #f9f9f9
}

.table-hover tbody tr:hover>td,.table-hover tbody tr:hover>th {
    background-color: #f5f5f5
}

table td[class*="span"],table th[class*="span"],.row-fluid table td[class*="span"],.row-fluid table th[class*="span"] {
    display: table-cell;
    float: none;
    margin-left: 0
}

.table td.span1,.table th.span1 {
    float: none;
    width: 44px;
    margin-left: 0
}

.table td.span2,.table th.span2 {
    float: none;
    width: 124px;
    margin-left: 0
}

.table td.span3,.table th.span3 {
    float: none;
    width: 204px;
    margin-left: 0
}

.table td.span4,.table th.span4 {
    float: none;
    width: 284px;
    margin-left: 0
}

.table td.span5,.table th.span5 {
    float: none;
    width: 364px;
    margin-left: 0
}

.table td.span6,.table th.span6 {
    float: none;
    width: 444px;
    margin-left: 0
}

.table td.span7,.table th.span7 {
    float: none;
    width: 524px;
    margin-left: 0
}

.table td.span8,.table th.span8 {
    float: none;
    width: 604px;
    margin-left: 0
}

.table td.span9,.table th.span9 {
    float: none;
    width: 684px;
    margin-left: 0
}

.table td.span10,.table th.span10 {
    float: none;
    width: 764px;
    margin-left: 0
}

.table td.span11,.table th.span11 {
    float: none;
    width: 844px;
    margin-left: 0
}

.table td.span12,.table th.span12 {
    float: none;
    width: 924px;
    margin-left: 0
}

.table tbody tr.success>td {
    background-color: #dff0d8
}

.table tbody tr.error>td {
    background-color: #f2dede
}

.table tbody tr.warning>td {
    background-color: #fcf8e3
}

.table tbody tr.info>td {
    background-color: #d9edf7
}

.table-hover tbody tr.success:hover>td {
    background-color: #d0e9c6
}

.table-hover tbody tr.error:hover>td {
    background-color: #ebcccc
}

.table-hover tbody tr.warning:hover>td {
    background-color: #faf2cc
}

.table-hover tbody tr.info:hover>td {
    background-color: #c4e3f3
}
.accountActionButtons__accountButton {
    position: relative;
    width: auto;
    margin: 0px;
    border-radius: 4px;
    font-weight: 600;
    color: #FFFFFF;
    cursor: default;
    padding: 10px 12px;
    font-size: 14px;
    border: 1px solid #DAE1E9;
    color: #9BA6B2;
    background-color: #FFFFFF;
    color: #DAE1E9;
    background-color: #F9FBFC;
    webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
}
.accountActionButtons__accountButton:hover {
    color: #4E5C6E;
    border: 1px solid #9BA6B2;
}
.accountActionButtons__sendIcon {
    fill: #DAE1E9;
    width: 13px;
    height: 13px;
    margin-right: 8px;
}
.accountActionButtons__QRIcon {
    fill: #9BA6B2;
    width: 13px;
    height: 13px;
    margin-right: 8px;
}







/*--- Navisgation ---*/
.avenir-font {
    font-family: "AvenirNext", -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue";
    font-weight: 400;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
}


.Navbar__LinkContent {
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
    width: 1180px;


}
.Navbar__LinkContainer {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
}
.Navbar__LinkContainer {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    cursor: pointer;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
    position: relative;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    cursor: pointer;
    color: #0667D0;
}
.Navbar__LinkContainer .Navbar-icon {
    width: 16px;
    height: 16px;
    margin-right: 10px;
    fill: currentColor;

    position: relative;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    cursor: pointer;
    color: #0667D0;
}
.Navbar__LinkContainer .Navbar__Title {
    font-size: 18px;
    font-weight: 500;
}



/*--- Widget ---*/
.dashboard__dashPanel .flex__flex-column {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
}
.dashboard__dashPanel {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);
    background-color: #FFFFFF;
    border-radius: 4px;
    border: 1px solid #DAE1E9;
}
.widgetHeader__wrapper {
    -webkit-flex-shrink: 0;
    -ms-flex-shrink: 0;
    flex-shrink: 0;
    height: 54px;
    padding: 0px 20px;
    border-bottom: 1px solid #DAE1E9;


    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
}
.heading__styledHeading {
    margin: 0;
    font-weight: 500;
    color: #0667D0;
    font-size: 18px;
}
.balanceRow__wrapper {
    -webkit-flex-shrink: 0;
    -ms-flex-shrink: 0;
    flex-shrink: 0;
    height: 54px;
    padding: 20px;
    border-bottom: 1px solid #DAE1E9;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
}
.balanceRow__title {
    min-width: 175px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
}
.balanceRow__icon {
    margin-right: 16px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
}
.balanceRow__text {
    display: inline-block;
    font-weight: 500;
    font-size: 18px;
    color: #4E5C6E;
}
.balanceRow__amount-text {
    display: inline-block;
    font-weight: 500;
    font-size: 16px;
    color: #9BA6B2;
}
.widgetFooter__wrapper {
    -webkit-flex-shrink: 0;
    -ms-flex-shrink: 0;
    flex-shrink: 0;
    height: 54px;
    font-weight: 500;
    color: #7D95B6;
    -webkit-transition: all 0.25s ease;
    transition: all 0.25s ease;
    font-size: 16px;

    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
}

/*--- User Profile ---*/
.user-profile .profile-image-preview {
    float: left;
    padding: 10px 30px 0 15px;
    max-width: 50px;
    max-height: 50px;
    border-radius: 6px
}

.user-profile .profile-image-preview img {
    width: 50px;
    height: 50px;
    border-radius: 100px;
    opacity: 0;
    -webkit-transition: all 0.2s ease-out;
    transition: all 0.2s ease-out
}

.user-profile .profile-image-preview img.visible {
    opacity: 1.0
}

.user-profile .profile-image-options {
    position: relative;
    display: inline-block;
    min-width: 85px;
    margin-right: 30px;
    height: 26px
}

.user-profile .profile-image-progress {
    position: absolute;
    margin-top: 30px;
    width: 100%;
    height: 6px;
    background: #e6e6e6;
    border-radius: 20px;
    opacity: 0;
    -webkit-transform: translateY(-5px);
    -ms-transform: translateY(-5px);
    transform: translateY(-5px);
    -webkit-transition: all 0.2s ease-out;
    transition: all 0.2s ease-out
}

.user-profile .profile-image-progress.image-uploading {
    opacity: 1.0;
    -webkit-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0)
}

.user-profile .profile-image-progress span {
    display: block;
    width: 0%;
    height: 100%;
    background: #2b71b1;
    border-radius: 20px;
    -webkit-transition: all 0.1s ease-out;
    transition: all 0.1s ease-out
}

.user-profile .profile-image-buttons {
    position: absolute;
    opacity: 0;
    -webkit-transform: translateY(5px);
    -ms-transform: translateY(5px);
    transform: translateY(5px);
    -webkit-transition: all 0.2s ease-out;
    transition: all 0.2s ease-out
}

.user-profile .profile-image-buttons.visible {
    opacity: 1.0;
    -webkit-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0)
}

.user-profile .profile-image-buttons .help-link {
    padding: 0 8px;
    font-size: 0.95em
}

.user-profile .profile-image-buttons span.errors {
    display: block;
    font-size: 90%;
    line-height: 17px
}



.nav {
    margin-left: 0;
    margin-bottom: 20px;
    list-style: none;
}

.nav-tabs {
    margin: 0 -25px 25px!important;
    padding: 0 25px!important;
}

.nav-tabs {
    border-bottom: 1px solid #eee;
}
.nav-tabs li:first-child {
    margin-left: 0;
}

.nav-tabs li {
    margin: 0 0 -1px 0;
}

.nav-tabs li {
    margin: 0 15px;
    font-size: 14px;
}

.nav-tabs>li {
    margin-bottom: -1px;
}

.nav-tabs>li, .nav-pills>li {
    float: left;
}


.nav>li>a:focus,.nav>li>a:hover {
    background-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none
}

.nav>li>a {
    padding: 21px 14px;
    font-size: 16px;
    font-weight: 500;
    color: #C0C0C0;
    border-bottom: 1px solid transparent;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.nav-tabs>.active>a {
    color: #0067C8;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-bottom: 1px solid #0067C8;
    background: none
}

.nav-tabs>.active>a:hover,.nav-tabs>.active>a:focus {
    cursor: pointer;
    box-shadow: none;
    -webkit-box-shadow: none;
    border-bottom: 1px solid #0067C8
}



.nav-tabs:before,.nav-tabs:after,.nav-pills:before,.nav-pills:after {
    display: table;
    content: "";
    line-height: 0;
}

.nav-tabs:after,.nav-pills:after {
    clear: both;
}

.nav-tabs>li,.nav-pills>li {
    float: left
}
.nav-tabs>li>a,.nav-pills>li>a {
    padding-right: 12px;
    padding-left: 12px;
    margin-right: 2px;
    line-height: 14px
}
.nav-tabs {
    border-bottom: 1px solid #ddd
}
.nav-tabs>li {
    margin-bottom: -1px
}
.nav-tabs>li>a {
    padding-top: 8px;
    padding-bottom: 8px;
    line-height: 20px;
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0
}
.nav>li>a {
    display: block;
    padding: 21px 14px;
    font-size: 16px;
    font-weight: 500;
    color: #C0C0C0;
    border-bottom: 1px solid transparent;
    -webkit-box-shadow: none;
    box-shadow: none;
    line-height: 20px;
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0;
}
.nav>li>a:focus, .nav>li>a:hover {
    text-decoration: none;
    background-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.nav-tabs>li>a:hover {
    background: transparent;
    color: #444;
    -webkit-box-shadow: 0 -1px #ccc inset;
    box-shadow: 0 -1px #ccc inset;
    -webkit-transition: 0.15s all ease;
    transition: 0.15s all ease;
}

/*--- User Profile ---*/
.panel__container {
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);
    background-color: #FFFFFF;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    height: 100%;
    max-height: 100%;
    overflow: hidden;
    border-radius: 4px;
    border: 1px solid #DAE1E9;
}
.accounts__header {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
    -webkit-flex: 0 0 54px;
    -ms-flex: 0 0 54px;
    flex: 0 0 54px;
    padding: 0px 20px;
    border-bottom: 1px solid #DAE1E9;
}
.accounts__heightWrapper {
    /*-webkit-flex: height:100%;*/
    /*-ms-flex: height:100%;*/
    /*flex: height:100%;*/
    max-height: 100%;
    overflow: hidden;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
}
.accounts__accountListWrapper {
    position: relative;
    -webkit-flex: 0 0 360px;
    -ms-flex: 0 0 360px;
    flex: 0 0 360px;
    padding-bottom: 58px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
}
.accountList__accountsList {
    overflow-y: scroll;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
}
.accountList__accountLink.active .accountListItem__selectedIndicator {
    -webkit-flex: 0 0 1px;
    -ms-flex: 0 0 1px;
    flex: 0 0 1px;
    margin-top: -1px;
    background-color: #0667D0;
}
.accountList__accountLink.active .accountListItem__account {
    background-color: #fff;
}
.accountListItem__account {
    min-width: 360px;
    cursor: pointer;
    min-width: 360px;
    cursor: pointer;
    background-color: #F9FBFC;
    border-bottom: 1px solid #DAE1E9;
}
.accountListItem__selectedIndicator {
    webkit-flex: 0 0 1px;
    -ms-flex: 0 0 1px;
    flex: 0 0 1px;
}
.accountListItem__contentWrap {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
}
.accountListItem__icon {
    padding: 16px;
    padding-top: 20px;
}
.accountListItem__details {
    padding: 16px 16px 16px 0;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
}
.editableAccountName__accountName {
    margin-bottom: 4px;
    max-width: 275px;
    text-overflow: ellipsis;
    overflow: hidden;
    display: inline-block;
    font-weight: 600;
    font-size: 16px;
    color: #4E5C6E;
}
.accountListItem__details .text__Font {
    display: inline-block;
    font-weight: 500;
    font-size: 16px;
    color: #4E5C6E;
}
.accountListItem__Actions {
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    margin-top: 16px;
}
.accountListItem__oreIcon {
    fill: #9BA6B2;
}
.accountListItem__Actions .flex__flex-row button:not(:first-child) {
    margin-left: 8px;
    margin-right: 8px;
}
.menuButton__container .button__Container{
    width: 41px;
    height: 41px;
}
.accounts__footerLink {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 18px;
    border-bottom-left-radius: 4px;
    border-top: 1px solid #DAE1E9;
    background-color: #FFFFFF;
    cursor: pointer;
    color: #9BA6B2;
    font-weight: 500;
}
.accounts__footerLink span {
    font-size: 16px;
}
.accounts__footerLink span:hover {
    color: #4E5C6E;
}
.accounts__plusIcon {
    width: 12px;
    height: 12px;
    margin-right: 6px;
    fill: #9BA6B2
}
.accounts__accountDetailsContainer {
    border-left: 1px solid #DAE1E9;
}



/* modal */
.modal-close-icon {
    width: 18px;
    height: 18px;
    margin-left: auto;
    fill: #9BA6B2;
    cursor: pointer;
    -webkit-transition: fill 0.15s ease;
    transition: fill 0.15s ease;
}

.modal-close-icon:hover {
    fill: #4E5C6E;
}

.modal-dialog {
    -webkit-transform: translate(0,-50%);
    -o-transform: translate(0,-50%);
    transform: translate(0,-50%);
    top: 25%;
    margin: 0 auto;
}

.modal-header .close {
    padding: 15px;
    margin: -3px -10px -15px auto;
}

.modal-title {
    font-weight: 500;
    color: #4E5C6E;
}

.text-grey {
    color: #4E5C6E;
}



/*STYLE FOR MAX*/
.citypickeritem{
        padding: .35rem 1.25rem; 
      }
      .citypicker_list{
       max-height: 218px;
        overflow-x: auto;
        display: none;
        position: absolute;
        background-color: #fff;
        z-index: 1;
        left: 15px;
        right: 15px;
        margin-top: 2px;
      }
/*STYLE FOR MAX*/

</style>


<div style="padding: 50px; background: #ffffff;">


    <div style="overflow: hidden">
        <h1 style="width: 100%; text-align: center;">Text</h1>

        <h2>H2 text</h2>
        <br>
        <h4>H4 text</h4>
        <legend>Legend text</legend>
        <p class="lead">Paragraph lead text</p>
        <p>Paragraph simple text</p>
        <a href="#">Link</a>
    </div>


    <div class="avenir-font" style="overflow: hidden;">
        <h1 style="width: 100%; text-align: center;">Form element</h1>

        <label>
            <input type="checkbox"  checked="checked">
            Checkbox
        </label>

        <br>

        <button class="button__container button__container-blue">
            <div class="button__content flex__flex-row">Button</div>
        </button>

        <button class="button__container button__container-grey">
            <div class="button__content flex__flex-row">Button</div>
        </button>

        <a href="#" id="choose_profile_image" class="btn">Button</a>

        <a href="#" class="btn btn-primary">Button</a>

        <!-- Button trigger modal -->
        <button type="button" class="button__container button__container-blue" data-toggle="modal" data-target="#exampleModal">
            <div class="button__content flex__flex-row">Modal</div>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="modal-close-icon"><path d="M18.1 19.17l1.4-1.42L1.7.29.3 1.7z"></path><path d="M19.5 1.71L18.1.3.3 17.75l1.4 1.42z"></path></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <h3 class="text-center text-grey mt-4">Lorem ipsum</h3>
                        <h4 class="text-center text-grey mt-4">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</h4>
                        <p class="text-center mt-4">
                            <button class="button__container button__container-blue">
                                <div class="button__content flex__flex-row">Button</div>
                            </button>
                        </p>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <br><br>

        <label for="">Field label</label>
        <input type="text" value="Text field" style="width: 435px; height: 50px;">
        <input type="text" value="Disabled field" style="width: 235px; height: 50px;" disabled="disabled">

        <select style="width: 200px;">
            <option value="">Select</option>
            <option value="1">Option 1</option>
            <option value="1">Option 2</option>
            <option value="1">Option 3</option>
            <option value="1">Option 4</option>
            <option value="1">Option 5</option>
        </select>

        <br>
        <br>
    </div>

{{--
    <div class="avenir-font" style="overflow: hidden;">
        <h1 style="width: 100%; text-align: center;">Nav</h1>


        <div class="Navbar d-flex">
            <div class="Navbar__LinkContainer" role="button">
                <div class="Navbar__LinkContent">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="Navbar-icon">
                        <path d="M6 9H1a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1zm0 7H1a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1zm9-10h-5a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1zm0 10h-5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1z"></path>
                    </svg>
                    <div class="Navbar__Title">Dashboard</div>
                </div>
            </div>
        </div>


    </div>

--}}





    <div class="avenir-font" style="overflow: hidden; margin-bottom: 50px;">
        <h1 style="width: 100%; text-align: center;">Widget</h1>


        <div style="width: 576px; margin-right: 30px; float: left;">
            <div class="dashboard__dashPanel">
                <div class="flex__flex-column">
                    <div class="widgetHeader__wrapper">
                        <div class="flex__flex-row">
                            <h4 class="heading__styledHeading">Title</h4>
                        </div>
                    </div>
                    <div class="flex__flex-row">
                        <div class="flex__flex-column">
                            <div class="balanceRow__wrapper">
                                <div class="balanceRow__title">
                                    <div class="balanceRow__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" class="CurrencyIcon-ljiVLA douUXB"><g fill="none" fill-rule="evenodd"><circle cx="19" cy="19" r="19" fill="#B5B5B5" fill-rule="nonzero"></circle><path fill="#FFF" d="M12.29 28.04l1.29-5.52-1.58.67.63-2.85 1.64-.68L16.52 10h5.23l-1.52 7.14 2.09-.74-.58 2.7-2.05.8-.9 4.34h8.1l-.99 3.8z"></path></g></svg>
                                    </div>
                                    <span class="balanceRow__text">Title</span>
                                </div>
                                <div class="flex__flex-row">
                                    <div class="flex__flex-column">
                                        <div class="balanceRow__amount">
                                            <span class="balanceRow__amount-text" style="color: #4E5C6E">0.0000 LTC</span>
                                        </div>
                                        <div class="balanceRow__amount">
                                            <span class="balanceRow__amount-text">UAH0.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex__flex-row">
                        <div class="flex__flex-column">
                            <div class="balanceRow__wrapper">
                                <div class="balanceRow__title">
                                    <div class="balanceRow__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" class="CurrencyIcon-ljiVLA douUXB"><g fill="none" fill-rule="evenodd"><circle cx="19" cy="19" r="19" fill="#B5B5B5" fill-rule="nonzero"></circle><path fill="#FFF" d="M12.29 28.04l1.29-5.52-1.58.67.63-2.85 1.64-.68L16.52 10h5.23l-1.52 7.14 2.09-.74-.58 2.7-2.05.8-.9 4.34h8.1l-.99 3.8z"></path></g></svg>
                                    </div>
                                    <span class="balanceRow__text">Title</span>
                                </div>
                                <div class="flex__flex-row">
                                    <div class="flex__flex-column">
                                        <div class="balanceRow__amount">
                                            <span class="balanceRow__amount-text" style="color: #4E5C6E">0.0000 LTC</span>
                                        </div>
                                        <div class="balanceRow__amount">
                                            <span class="balanceRow__amount-text">UAH0.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex__flex-row">
                        <div class="flex__flex-column">
                            <div class="balanceRow__wrapper">
                                <div class="balanceRow__title">
                                    <div class="balanceRow__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" class="CurrencyIcon-ljiVLA douUXB"><g fill="none" fill-rule="evenodd"><circle cx="19" cy="19" r="19" fill="#B5B5B5" fill-rule="nonzero"></circle><path fill="#FFF" d="M12.29 28.04l1.29-5.52-1.58.67.63-2.85 1.64-.68L16.52 10h5.23l-1.52 7.14 2.09-.74-.58 2.7-2.05.8-.9 4.34h8.1l-.99 3.8z"></path></g></svg>
                                    </div>
                                    <span class="balanceRow__text">Title</span>
                                </div>
                                <div class="flex__flex-row">
                                    <div class="flex__flex-column">
                                        <div class="balanceRow__amount">
                                            <span class="balanceRow__amount-text" style="color: #4E5C6E">0.0000 LTC</span>
                                        </div>
                                        <div class="balanceRow__amount">
                                            <span class="balanceRow__amount-text">UAH0.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widgetFooter__wrapper flex__flex-row">
                        Total Balance&nbsp;≈&nbsp;<span>UAH0.00</span>
                    </div>
                </div>
            </div>
        </div>

        <div style="width: 700px; float: left;">
            <div class="content__block">
                <div class="row">
                    <ul id="account_tabs" class="nav nav-tabs">
                        <li class="active"><a href="#">Tab 1</a></li>
                        <li class=""><a href="#">Tab 2</a></li>
                        <li class=""><a href="#">Tab 3</a></li>
                        <li class=""><a href="#">Tab 4</a></li>
                        <li class=""><a href="#">Tab 5</a></li>
                    </ul>
                    <div>
                        <legend>User Profile</legend>

                        <div class="span5 user-profile">
                            <div>
                                <div class="d-flex justify-content-between col-10 pl-0 pr-0">
                                    <span class="profile-image-preview">
                                        <img width="50" height="50" class="avatar visible" src="https://images.coinbase.com/avatar?h=X21V6OpaApWl9sSyWScf1ffglfQPz%2BYb%2BChTpbZuRGhp7FTIvjrHPYfu39zU%0At0k0&amp;s=150" alt="Avatar?h=x21v6opaapwl9ssywscf1ffglfqpz%2byb%2bchtpbzurghp7ftivjrhpyfu39zu%0at0k0&amp;s=150">
                                    </span>
                                    <div>
                                        <p class="formlabel">Change Picture</p>
                                        <p>
                                            Max file size is 20Mb. <br>
                                            <a href="#" id="remove_profile_image" class="muted" style="display:none">Remove</a>
                                            <a href="https://www.coinbase.com/external_redirect?link=https%3A%2F%2Fwww.gravatar.com&amp;signature=9395ff1a33e036229f80834d7c49a60bc3a0bec0b91ae8c67b194a4db330bfd9&amp;timestamp=1513634680" target="_blank" id="gravatar_description" class="muted" rel="noreferrer noopener">You can also use Gravatar.</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border"></div>

                        <div class="span4 passwordbox">
                            <div class="top">
                                <div class="passwordlabel">
                                    <p class="formlabel">Change Password</p>
                                    <p class="twofactor">Enable 2-factor authentication on <a href="settings/security_settings">the security page</a>.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <hr style="margin: 50px; width: 100%; display: inline-block;">

        <div style="width: 400px; float: left; margin-right: 50px;">
            <div id="applications">
                <legend>Title</legend>
                <div class="alert alert-info alert-full" id="none_yet">
                    <i class="icon-info-circled"></i>
                    <div>
                        <p>
                            <strong>You haven't authorized any applications yet.</strong><br>
                            After connecting an application with your account, you can manage or revoke its access here.<br>
                        </p>
                    </div>
                </div>
                <div class="modal fade hide widget" id="account_app_modal"></div>
            </div>

        </div>

        <div style="width: 400px; float: left; margin-right: 50px;">
            <legend>Title</legend>
            <h4>Web Sessions</h4>
            <p>
                These sessions are currently signed in to your account. <br>
                <a href="/signout_sessions" confirm="Are you sure you want to sign out all other sessions?" rel="nofollow" data-method="delete">
                    Sign out all other sessions
                </a>
            </p>
        </div>


        <hr style="margin: 50px; width: 100%; display: inline-block;">

        <div class="panel__container" style="width: 1200px; margin: 0 auto;">
            <div class="accounts__header">
                <h4 class="heading__styledHeading" style="font-size: 18px;">
                    <span>Title</span>
                </h4>
            </div>
            <div class="accounts__heightWrapper">
                <div class="accounts__accountListWrapper">
                    <div class="accountList__accountsList">
                        <a class="accountList__accountLink active">
                            <div class="accountListItem__account d-flex">
                                <div class="accountListItem__selectedIndicator d-flex"></div>
                                <div class="accountListItem__contentWrap d-flex">
                                    <div class="accountListItem__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 32 32" class="CurrencyIcon-ewqwUN frbKlS"><g fill="none" fill-rule="evenodd"><ellipse cx="16" cy="16" fill="#6F7CBA" rx="16" ry="16"></ellipse><path fill="#FFF" d="M10.13 17.76c-.1-.15-.06-.2.09-.12l5.49 3.09c.15.08.4.08.56 0l5.58-3.08c.16-.08.2-.03.1.11L16.2 25.9c-.1.15-.28.15-.38 0l-5.7-8.13zm.04-2.03a.3.3 0 0 1-.13-.42l5.74-9.2c.1-.15.25-.15.34 0l5.77 9.19c.1.14.05.33-.12.41l-5.5 2.78a.73.73 0 0 1-.6 0l-5.5-2.76z"></path></g></svg>
                                    </div>
                                    <div class="d-flex" style="flex: 1 1 auto;">
                                        <div class="accountListItem__details">
                                            <span class="editableAccountName__accountName">ETH Wallet</span>
                                            <div>
                                                <span class="text__Font">
                                                    <span>0.0000 ETH</span>
                                                </span>
                                                <span>
                                                    <span class="Currency__SpacerText">≈</span>
                                                    <span class="text__Font">
                                                        <span style="color: #9BA6B2;">UAH0.00</span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="accountListItem__Actions d-flex">
                                                <div class="flex__flex-row" style="flex: 1 1 auto;">
                                                    <button class="accountActionButtons__accountButton button__Container" disabled="">
                                                        <div class="button__Content d-flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="accountActionButtons__sendIcon"><path d="M15.7.3a1 1 0 0 0-1.04-.24l-14 5a1 1 0 0 0-.1 1.83l4.58 2.3L11 5l-4.19 5.86 2.3 4.59a1 1 0 0 0 1.83-.11l5-14a1 1 0 0 0-.23-1.05z"></path></svg>
                                                            <span>Send</span>
                                                        </div>
                                                    </button>
                                                    <button class="accountActionButtons__accountButton button__Container">
                                                        <div class="button__Content d-flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" class="accountActionButtons__QRIcon"><path d="M6.42 6.42H0V0h6.42v6.42zM1.17 5.25h4.08V1.17H1.17v4.08zM14 6.42H7.58V0H14v6.42zM8.75 5.25h4.08V1.17H8.75v4.08zM6.42 14H0V7.58h6.42V14zm-5.25-1.17h4.08V8.75H1.17v4.08zM14 11.67h-1.17V8.75h-1.16v1.75h-3.5V7.58h1.16v1.75h1.17V7.58H14zM14 14H8.17v-2.33h1.16v1.16H14z"></path><path d="M2.33 2.33h1.75v1.75H2.33zM9.92 2.33h1.75v1.75H9.92zM2.33 9.92h1.75v1.75H2.33z"></path></svg>
                                                            <span>Receive</span>
                                                        </div>
                                                    </button>
                                                </div>
                                                <div class="menuButton__container">
                                                    <button class="accountActionButtons__accountButton button__Container">
                                                        <div class="button__Content d-flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="3" viewBox="0 0 12 3" class="accountListItem__oreIcon"><path fill-rule="evenodd" d="M0 1.1C0 .8.11.53.33.31.55.11.8 0 1.12 0c.3 0 .56.1.78.3a1.04 1.04 0 0 1 0 1.53c-.2.22-.47.33-.78.33a1.22 1.22 0 0 1-.78-.3A1.04 1.04 0 0 1 0 1.08zm4.66 0c0-.3.11-.56.33-.78.22-.21.48-.32.8-.32.3 0 .55.1.78.3.22.21.33.47.33.76 0 .3-.1.56-.33.77a1.1 1.1 0 0 1-1.22.24A1.22 1.22 0 0 1 5 1.85a1.04 1.04 0 0 1-.34-.76zm4.66 0c0-.3.11-.56.33-.78.22-.21.49-.32.8-.32.3 0 .55.1.78.3.22.21.33.47.33.76 0 .3-.1.56-.33.77-.21.22-.48.33-.79.33a1.22 1.22 0 0 1-.78-.3 1.04 1.04 0 0 1-.34-.77z"></path></svg>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="accountList__accountLink">
                            <div class="accountListItem__account d-flex">
                                <div class="accountListItem__selectedIndicator d-flex"></div>
                                <div class="accountListItem__contentWrap d-flex">
                                    <div class="accountListItem__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 32 32" class="CurrencyIcon-ewqwUN frbKlS"><g fill="none" fill-rule="evenodd"><ellipse cx="16" cy="16" fill="#6F7CBA" rx="16" ry="16"></ellipse><path fill="#FFF" d="M10.13 17.76c-.1-.15-.06-.2.09-.12l5.49 3.09c.15.08.4.08.56 0l5.58-3.08c.16-.08.2-.03.1.11L16.2 25.9c-.1.15-.28.15-.38 0l-5.7-8.13zm.04-2.03a.3.3 0 0 1-.13-.42l5.74-9.2c.1-.15.25-.15.34 0l5.77 9.19c.1.14.05.33-.12.41l-5.5 2.78a.73.73 0 0 1-.6 0l-5.5-2.76z"></path></g></svg>
                                    </div>
                                    <div class="d-flex" style="flex: 1 1 auto;">
                                        <div class="accountListItem__details">
                                            <span class="editableAccountName__accountName">ETH Wallet</span>
                                            <div>
                                                <span class="text__Font">
                                                    <span>0.0000 ETH</span>
                                                </span>
                                                <span>
                                                    <span class="Currency__SpacerText">≈</span>
                                                    <span class="text__Font">
                                                        <span style="color: #9BA6B2;">UAH0.00</span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="accountListItem__Actions d-flex">
                                                <div class="flex__flex-row" style="flex: 1 1 auto;">
                                                    <button class="accountActionButtons__accountButton button__Container" disabled="">
                                                        <div class="button__Content d-flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="accountActionButtons__sendIcon"><path d="M15.7.3a1 1 0 0 0-1.04-.24l-14 5a1 1 0 0 0-.1 1.83l4.58 2.3L11 5l-4.19 5.86 2.3 4.59a1 1 0 0 0 1.83-.11l5-14a1 1 0 0 0-.23-1.05z"></path></svg>
                                                            <span>Send</span>
                                                        </div>
                                                    </button>
                                                    <button class="accountActionButtons__accountButton button__Container">
                                                        <div class="button__Content d-flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" class="accountActionButtons__QRIcon"><path d="M6.42 6.42H0V0h6.42v6.42zM1.17 5.25h4.08V1.17H1.17v4.08zM14 6.42H7.58V0H14v6.42zM8.75 5.25h4.08V1.17H8.75v4.08zM6.42 14H0V7.58h6.42V14zm-5.25-1.17h4.08V8.75H1.17v4.08zM14 11.67h-1.17V8.75h-1.16v1.75h-3.5V7.58h1.16v1.75h1.17V7.58H14zM14 14H8.17v-2.33h1.16v1.16H14z"></path><path d="M2.33 2.33h1.75v1.75H2.33zM9.92 2.33h1.75v1.75H9.92zM2.33 9.92h1.75v1.75H2.33z"></path></svg>
                                                            <span>Receive</span>
                                                        </div>
                                                    </button>
                                                </div>
                                                <div class="menuButton__container">
                                                    <button class="accountActionButtons__accountButton button__Container">
                                                        <div class="button__Content d-flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="3" viewBox="0 0 12 3" class="accountListItem__oreIcon"><path fill-rule="evenodd" d="M0 1.1C0 .8.11.53.33.31.55.11.8 0 1.12 0c.3 0 .56.1.78.3a1.04 1.04 0 0 1 0 1.53c-.2.22-.47.33-.78.33a1.22 1.22 0 0 1-.78-.3A1.04 1.04 0 0 1 0 1.08zm4.66 0c0-.3.11-.56.33-.78.22-.21.48-.32.8-.32.3 0 .55.1.78.3.22.21.33.47.33.76 0 .3-.1.56-.33.77a1.1 1.1 0 0 1-1.22.24A1.22 1.22 0 0 1 5 1.85a1.04 1.04 0 0 1-.34-.76zm4.66 0c0-.3.11-.56.33-.78.22-.21.49-.32.8-.32.3 0 .55.1.78.3.22.21.33.47.33.76 0 .3-.1.56-.33.77-.21.22-.48.33-.79.33a1.22 1.22 0 0 1-.78-.3 1.04 1.04 0 0 1-.34-.77z"></path></svg>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="accounts__footerLink d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" class="accounts__plusIcon"><path d="M15.93 7.55h-6v-6c0-.6-.4-1-1-1s-1 .4-1 1v6h-6c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1v-6h6c.6 0 1-.4 1-1s-.4-1-1-1z"></path></svg>
                        <span>New Account</span>
                    </div>
                </div>
                <div class="accounts__accountDetailsContainer"></div>
            </div>




        </div>

        <br><br><br>

        <table class="table table-condensed" style="width: 1000px">
            <thead>
            <tr>
                <th width="15%">Signed In</th>
                <th width="20%">Browser</th>
                <th width="15%">IP Address</th>
                <th width="25%">Near</th>
                <th width="8%">Current</th>
                <th width="7%">&nbsp;</th>
            </tr>
            </thead>
            <tbody><tr>
                <td>2 days ago</td>
                <td>Chrome (Windows)</td>
                <td>109.227.97.143</td>
                <td>Ukraine, Cherkasy</td>
                <td class="center">
                    <i class="icon icon-ok"></i>
                </td>
                <td>
                    <a href="/signout_session?id=5a3512b0f6f07803173b42e5" confirm="Are you sure you want to sign out this session?" rel="nofollow" data-method="delete">
                        <i class="icon-remove" title="" rel="tooltip" data-placement="bottom" data-original-title="Sign out"></i>
                    </a> </td>
            </tr>
            <tr>
                <td>about 15 hours ago</td>
                <td>Chrome (Windows)</td>
                <td>78.137.2.161</td>
                <td>Ukraine, Cherkasy</td>
                <td class="center">
                </td>
                <td>
                    <a href="/signout_session?id=5a3776b9238313013b0129ea" confirm="Are you sure you want to sign out this session?" rel="nofollow" data-method="delete">
                        <i class="icon-remove" title="" rel="tooltip" data-placement="bottom" data-original-title="Sign out"></i>
                    </a> </td>
            </tr>
            </tbody>
        </table>


        <hr style="margin: 50px; width: 100%; display: inline-block;">


    </div>


    <div style="overflow: hidden;">
        <h1 style="width: 100%; text-align: center;">Lists</h1>

        <div class="stepbystep carousel-indicators" style="max-width: 600px; float: left;">
            <div class="active">
                <div class="step">
                    <div class="stepnumber"><div class="number">1</div></div>
                    <div class="steptext">
                        <div class="numberlabel">Title 1 (Active)</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="step">
                    <div class="stepnumber"><div class="number">2</div></div>
                    <div class="steptext">
                        <div class="numberlabel">Title 2</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="featurecontent" style="max-width: 600px; float: left">
            <div class="featurebox">
                <img src="https://www.coinbase.com/assets/home/phone-412f73b110401e7448e27cdf9a845d1637085f154f3fb8e20bc6feb4b02f1de4.png" data-src="https://www.coinbase.com/assets/home/phone-412f73b110401e7448e27cdf9a845d1637085f154f3fb8e20bc6feb4b02f1de4.png" alt="Coinbase mobile apps">
                <div class="featuretext">
                    <div class="numberlabel">Title</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <a href="/mobile">Read more ›</a>
                </div>
            </div>
            <div class="featurebox">
                <img src="https://www.coinbase.com/assets/home/lock-69c8a91b6768243f47c9f60de9725781c325a1dd02a583eadc3f963876a2075d.png" data-src="https://www.coinbase.com/assets/home/lock-69c8a91b6768243f47c9f60de9725781c325a1dd02a583eadc3f963876a2075d.png" alt="Coinbase security">
                <div class="featuretext">
                    <div class="numberlabel">Title</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <a href="/security">Read more ›</a>
                </div>
            </div>
        </div>
    </div>


    <div style="overflow: hidden;">
        <h1 style="width: 100%; text-align: center;">Components</h1>
        <div class="numbers">
            <div class="numberbox">
                <div class="bignumber">
                    $100B+
                </div>
                <div class="numberlabel">Text text <br> text</div>
            </div>
            <div class="numberbox">
                <div class="bignumber">
                    10
                </div>
                <div class="numberlabel">Text text <br> text</div>
            </div>
            <div class="numberbox">
                <div class="bignumber">
                    10M+
                </div>
                <div class="numberlabel">Text text <br> text</div>
            </div>
        </div>
    </div>

    <h1>SELECT 2</h1>
    <select class="js-example-basic-single form-control">
        <option value="pt">PT Sans</option>
        <option value="1">1</option>
        <option value="2">1</option>
    </select>



    <h1 class="mt-3">Max!</h1>
    <p>Option picker with typing</p>
       <div class="row pb-5">
          <div class="citypicker col-md-12">
            <label>Business chooses an industry</label>
            <div class="input_citypicker">
              <!-- First input -->
              <input type="text" class="form-control" name="city" placeholder="Start typing an industry name" id="citypicker">
              <!-- First input end -->

              <!-- Second element after pick -->
              <div class="input-group" style="display: none;" id="picked_city_block">

                <input type="text" class="form-control city_location_new" aria-describedby="btnGroupAddon" readonly >
                <!-- delete button -->
                <button class="input-group-addon delete" id="btnGroupAddon" style="cursor:pointer;" role="button">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 348.333 348.334" style="enable-background:new 0 0 348.333 348.334;" xml:space="preserve">
                  <g>
                    <path d="M336.559,68.611L231.016,174.165l105.543,105.549c15.699,15.705,15.699,41.145,0,56.85   c-7.844,7.844-18.128,11.769-28.407,11.769c-10.296,0-20.581-3.919-28.419-11.769L174.167,231.003L68.609,336.563   c-7.843,7.844-18.128,11.769-28.416,11.769c-10.285,0-20.563-3.919-28.413-11.769c-15.699-15.698-15.699-41.139,0-56.85   l105.54-105.549L11.774,68.611c-15.699-15.699-15.699-41.145,0-56.844c15.696-15.687,41.127-15.687,56.829,0l105.563,105.554   L279.721,11.767c15.705-15.687,41.139-15.687,56.832,0C352.258,27.466,352.258,52.912,336.559,68.611z"/>
                  </g>
                  </svg>
                </button>
                <!-- delete button end -->
              </div>
              <!-- Second element after pick -->

            </div>
            <!-- list block -->
            <div class="citypicker_list" id="citypicker_list">

              <div class="list-group" id="cityitems" style="padding: 1px;">

                <a href="#" class="list-group-item list-group-item-action citypickeritem">
                    <div class="float-left" id="left_category_block">
                        <span class="category">Services</span>
                        <p class="mb-0"><small>Category</small></p>
                    </div>
                    <div class="float-right" id="right_subcategory_block">
                        <span class="subcategory">Marketing Services</span>
                        <p class="mb-0"><small>Subcategory</small></p>
                    </div>                       
                </a>
                <a href="#" class="list-group-item list-group-item-action citypickeritem">
                    <div class="float-left" id="left_category_block">
                        <span class="category">Services2</span>
                        <p class="mb-0"><small>Category</small></p>
                    </div>
                    <div class="float-right" id="right_subcategory_block">
                        <span class="subcategory">Marketing Services2</span>
                        <p class="mb-0"><small>Subcategory</small></p>
                    </div>                      
                </a>
                <a href="#" class="list-group-item list-group-item-action citypickeritem">
                    <div class="float-left" id="left_category_block">
                        <span class="category">Services3</span>
                        <p class="mb-0"><small>Category</small></p>
                    </div>
                    <div class="float-right" id="right_subcategory_block">
                        <span class="subcategory">Marketing Services3</span>
                        <p class="mb-0"><small>Subcategory</small></p>
                    </div>                       
                </a>
                <a href="#" class="list-group-item list-group-item-action citypickeritem">
                    <div class="float-left" id="left_category_block">
                        <span class="category">Services4</span>
                        <p class="mb-0"><small>Category</small></p>
                    </div>
                    <div class="float-right" id="right_subcategory_block">
                        <span class="subcategory">Marketing Services4</span>
                        <p class="mb-0"><small>Subcategory</small></p>
                    </div>                        
                </a>
                

              </div>

            </div>
            <!-- list block end -->
          </div>
       </div>


</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/bob.js') }}"></script>
<script src="{{ asset('/js/main.js') }}"></script>
<script src="{{ asset('/js/cv_widget.js') }}"></script>
<script src="{{ asset('/js/login_wizard.js') }}"></script>
<script src="{{ asset('/js/landing-animation.js') }}"></script>
<script src="{{ asset('/js/jquery-ui.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- SCRIPT FOR MAX -->
<script>
      $(document).ready(function(){
        $("#citypicker").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#cityitems a").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });


      $(document).ready(function() {
          $("#citypicker").keyup(function() {
              if (this.value != null) {
                  $("#citypicker_list").css("display", "block");
              }
              else {
                    $("#citypicker_list").css("display", "none");
                   }

          });
      });

      $('#citypicker').blur(function()
      {
          if( !$(this).val() ) {
                $("#citypicker_list").css("display", "none");
          }
      });

      $(".citypickeritem").on('click',function(){
        var div_citypicker = $(this).find(".input_citypicker")

        var element = $(this);
        
        var category = element.find("#left_category_block .category").html();
        var subcategory = element.find("#right_subcategory_block .subcategory").html();


        $("#citypicker").hide();
        $("#picked_city_block").show();

        $(".city_location_new").val(category + " - " + subcategory);

        $("#citypicker_list").css("display", "none");

        var test= $(".delete").html();

    }); 

      $(".input_citypicker").on('click','button.delete',function(){
          
          $("#picked_city_block").hide();
          $("#citypicker").val("");
          $("#citypicker").show();
       });

    </script>
    <!-- SCRIPT FOR MAX -->


    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
