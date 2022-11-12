<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reservation/Schedule Page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<?php  
		// Header
		require_once("Header.php");
		require_once("utils.php");
		checkAndStartSession();
		$logged_in = isLoggedIn();

		// Connect to MySQL
		require_once("Connect.php");
	?>
	<?php  
		echo "
			<!-- Here we are using attributes like
        cellspacing and cellpadding -->
  
    <!-- The purpose of the cellpadding is 
        the space that a user want between
        the border of cell and its contents-->
  
    <!-- cellspacing is used to specify the 
        space between the cell and its contents -->
    <h2 align='center' style='color: orange;'>January 2023</h2><br />
    <table bgcolor='lightgrey' align='center' cellspacing='5' cellpadding='21'>
  
        <!-- The tr tag is used to enter 
            rows in the table -->
  
        <!-- It is used to give the heading to the
            table. We can give the heading to the 
            top and bottom of the table -->
  
        <caption align='top'>
            <!-- Here we have used the attribute 
                that is style and we have colored 
                the sentence to make it better 
                depending on the web page-->
        </caption>
  
        <!-- Here th stands for the heading of the
            table that comes in the first row-->
  
        <!-- The text in this table header tag will 
            appear as bold and is center aligned-->
  
        <thead>
            <tr>
                <!-- Here we have applied inline style 
                     to make it more attractive-->
                <th style='color: white; background: purple;'>Sun</th>
                <th style='color: white; background: purple;'>Mon</th>
                <th style='color: white; background: purple;'>Tue</th>
                <th style='color: white; background: purple;'>Wed</th>
                <th style='color: white; background: purple;'>Thu</th>
                <th style='color: white; background: purple;'>Fri</th>
                <th style='color: white; background: purple;'>Sat</th>
            </tr>
        </thead>
  
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td>2</td>
            </tr>
            <tr></tr>
            <tr>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
            </tr>
            <tr>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
            </tr>
            <tr>
                <td>17</td>
                <td>18</td>
                <td>19</td>
                <td>20</td>
                <td>21</td>
                <td>22</td>
                <td>23</td>
            </tr>
            <tr>
                <td>24</td>
                <td>25</td>
                <td>26</td>
                <td>27</td>
                <td>28</td>
                <td>29</td>
                <td>30</td>
            </tr>
            <tr>
                <td>31</td>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
            </tr>
        </tbody>
    </table>";
	?>
	
	<?php
		// Footer 
		require_once("Footer.php"); 
	?>
</body>
</html>