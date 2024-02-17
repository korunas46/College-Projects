	-This is a SQL sports database consisting of a USER, SPORT, TEAM,
and EQUIPMENT table along with a PLAYER, COACH, and ADMIN subclass
along with the BUY table for the relationship between PLAYER and EQUIPMENT,
COACHES table for COACH and TEAM, NEEDS table for SPORT and EQUIPMENT,
and PLAYS_IN for PLAYER and TEAM.
	-The php website consists of a login page that leads to one of three
control panels based on the user subclass. All control panels have the
search for a team function. The admin page has functions for viewing
all players, viewing all coaches, creating a team, assigning a coach
to a team, listing most popular sports, players in most teams, coaches
with most teams, finding the average fee per player, and finding the
most popular equipment. The coach page has the functions for viewing
currently assigned teams, leaving a team, and adding players to a team.
The player page has functions for viewing currently assigned teams and
leaving a team. Each page, except the search team page, has a back
and logout button, and each page checks to see if the user is properly
logged in or is the right user type before displaying the page.
	-The file SportLFCCreateTables creates the sportlfc database and all of
its tables
	-The file SportLFCPopulateTables populates every table with data
for testing the database
	-The folder sportlfc contains all the php files for the website
