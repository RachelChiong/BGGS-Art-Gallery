--- Sample SQL that was used for the search query ---
--- Create a temporary table to query. This is to increase efficiency of the webpage as only the relevant fields are queried. Furthermore, a temporary table joins all the relevant information. 
CREATE TEMPORARY TABLE temptable(
    temp_id INT PRIMARY KEY AUTO_INCREMENT,
    ID INT(11),
    Title varchar(255),
    Artist_Name varchar(255),
    Media varchar(255),
    Location varchar(255),
    Image longblob
    );

INSERT INTO temptable(ID, Title, Artist_Name, Media, Location)
SELECT a.a_id, a.a_title, CONCAT(r.a_fname,' ', r.a_lname), m.m_name, l.room, a.img
FROM artworks AS a, artists AS r, locations AS l, media AS m
        WHERE a.artist_id = r.artist_id AND a.l_id = l.l_id AND a.m_id = m.m_id;

SELECT ID, Title, Artist_Name, Media, Location, Image FROM temptable WHERE 

	Location LIKE '%%' OR
    Media LIKE '%%' OR
    Artist_Name LIKE '%%' OR
    Title LIKE '%%';
    