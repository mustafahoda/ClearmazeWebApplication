<?php
session_start();
require 'db_connect_clearmaze.php';
$user_cc = $_SESSION['cc'];
$user_uni = $_SESSION['uni'];
$user_major = trim($_GET['major']);

// $user_uni = "University of Illinois at Chicago";
// $user_cc = "College of Dupage";
// $user_major = "Electrical Engineering";

$queryMajorAbv = $db -> query("SELECT abv FROM majors WHERE university = 'University of Illinois at Chicago' and `major` = '$user_major';");

while($temp = $queryMajorAbv->fetch()){
  $user_majorAbv = $temp[0];
}

$queryRelatedMajors = $db -> query("SELECT major2 FROM related_majors WHERE major1 = '$user_majorAbv';");

while($temp = $queryRelatedMajors->fetch()){
  $relatedMajorCode = $temp[0];
}

/*################################
  QUERY RESULTS FOR GENED TABLE
#################################*/

$queryGenEdHeaders = $db->query("
SELECT DISTINCT uni_courses.cat1
  FROM uni_courses
  INNER JOIN universities
  ON uni_courses.uni_abv = universities.abv
    WHERE uni_courses.cat1 IS NOT NULL
    AND uni_courses.cat1 != ''
    AND universities.university = '$user_uni'


UNION

SELECT DISTINCT uni_courses.cat2
  FROM uni_courses
  INNER JOIN universities
  ON uni_courses.uni_abv = universities.abv
    WHERE uni_courses.cat2 IS NOT NULL
    AND uni_courses.cat2 != ''
    AND universities.university = '$user_uni'

UNION

SELECT DISTINCT uni_courses.cat3
  FROM uni_courses
  INNER JOIN universities
  ON uni_courses.uni_abv = universities.abv
    WHERE uni_courses.cat3 IS NOT NULL
    AND uni_courses.cat3 != ''
    AND universities.university = '$user_uni'; ");

$numGenEdHeaders = $queryGenEdHeaders->rowcount();

$index = 0;
while($temp = $queryGenEdHeaders->fetch()){
  $rowGenEdCategory[$index] = $temp[0];
  $index = $index + 1;
}

sort($rowGenEdCategory);

for ($i=0; $i<$numGenEdHeaders; $i++) {
  $queryGenedCourseByCategory[$i] = $db->query("
  SELECT
    cc_courses.course_number,
    cc_courses.course_name,
    uni_courses.course_number,
    uni_courses.course_name,
    uni_courses.credit_hours
    FROM uni_courses

    INNER JOIN equivalencies
    ON equivalencies.uni_course_abv = uni_courses.abv

    INNER JOIN cc_courses
    ON equivalencies.cc_course_abv = cc_courses.abv

      WHERE equivalencies.cc_course_abv IN
          (SELECT cc_courses.abv
          FROM cc_courses
          WHERE cc_courses.cc_abv IN
              (SELECT community_colleges.abv
              FROM community_colleges
              WHERE community_colleges.community_college = '$user_cc'))

      AND equivalencies.uni_course_abv IN
          (SELECT gened_req.uni_course_abv
          FROM gened_req
          WHERE gened_req.uni_abv IN
              (SELECT universities.abv
              FROM universities
              WHERE universities.university = '$user_uni')
          AND gened_req.uni_course_abv IN
              	  (SELECT uni_courses.abv
              	  FROM uni_courses
              	  WHERE uni_courses.cat1 = '$rowGenEdCategory[$i]'
          	  	  OR uni_courses.cat2 = '$rowGenEdCategory[$i]'
                  OR uni_courses.cat3 = '$rowGenEdCategory[$i]'
                  AND uni_courses.cat1 IS NOT NULL
                  AND uni_courses.cat2 IS NOT NULL
                  AND uni_courses.cat3 IS NOT NULL))

      ORDER BY cc_courses.course_number;");

  $numGenedCourses[$i] = $queryGenedCourseByCategory[$i]->rowcount();
}

/*######################################
  QUERY RESULTS FOR MAJOR CORE TABLE
######################################*/

$queryMajorCourses = $db->query("
  SELECT
  cc_courses.course_number,
  cc_courses.course_name,
  uni_courses.course_number,
  uni_courses.course_name,
  uni_courses.credit_hours
    FROM equivalencies

  INNER JOIN uni_courses
    ON equivalencies.uni_course_abv = uni_courses.abv

  INNER JOIN cc_courses
    ON equivalencies.cc_course_abv = cc_courses.abv

    WHERE equivalencies.cc_course_abv IN
        (SELECT cc_courses.abv
        FROM cc_courses
        WHERE cc_courses.cc_abv IN
            (SELECT community_colleges.abv
            FROM community_colleges
            WHERE community_colleges.community_college = '$user_cc'))

    AND equivalencies.uni_course_abv IN
        (SELECT degree_req.uni_course_abv
        FROM degree_req
        WHERE degree_req.major_abv IN
            (SELECT majors.abv
            FROM majors
            WHERE majors.major = '$user_major'
            AND majors.university = '$user_uni')
        AND (degree_req.cat1 IS NULL OR degree_req.cat1 = '')
      	AND (degree_req.cat2 IS NULL OR degree_req.cat2 = '')
      	AND (degree_req.cat3 IS NULL OR degree_req.cat3 = ''))

    ORDER BY cc_courses.course_number;");

$numMajorCoreCourses = $queryMajorCourses->rowcount();

/*#########################################
  QUERY RESULTS FOR MAJOR ELECTIVES TABLE
##########################################*/

$queryMajorCategory = $db->query("
SELECT DISTINCT degree_req.cat1
            FROM degree_req
            INNER JOIN majors
            ON degree_req.major_abv =
            majors.abv
                WHERE degree_req.cat1 IS NOT NULL
                AND degree_req.cat1 != ''
                AND majors.major = '$user_major'
                AND majors.university = '$user_uni'
        UNION
SELECT DISTINCT degree_req.cat2
            FROM degree_req
            INNER JOIN majors
            ON degree_req.major_abv =
            majors.abv
                WHERE degree_req.cat2 IS NOT NULL
                AND degree_req.cat2 != ''
								AND majors.major = '$user_major'
                AND majors.university = '$user_uni'
        UNION
SELECT DISTINCT degree_req.cat3
            FROM degree_req
            INNER JOIN majors
            ON degree_req.major_abv =
            majors.abv
                WHERE degree_req.cat3 IS NOT NULL
                AND degree_req.cat3 != ''
								AND majors.major = '$user_major'
                AND majors.university = '$user_uni'
        UNION
SELECT DISTINCT degree_req.cat4
            FROM degree_req
            INNER JOIN majors
            ON degree_req.major_abv =
            majors.abv
                WHERE degree_req.cat4 IS NOT NULL
                AND degree_req.cat4 != ''
								AND majors.major = '$user_major'
                AND majors.university = '$user_uni'
");

$numMajorCategories = $queryMajorCategory->rowcount();

$index = 0;
while($temp = $queryMajorCategory->fetch()){
  $rowMajorCategory[$index] = $temp[0];
  $index = $index + 1;
}

sort($rowMajorCategory);

for ($i=0; $i<$numMajorCategories; $i++) {
  $queryMajorCourseByCategory[$i] = $db -> query("
      SELECT
          cc_courses.course_number,
          cc_courses.course_name,
          uni_courses.course_number,
          uni_courses.course_name,
          uni_courses.credit_hours
      FROM uni_courses
      INNER JOIN equivalencies
          ON equivalencies.uni_course_abv = uni_courses.abv
      INNER JOIN cc_courses
          ON equivalencies.cc_course_abv = cc_courses.abv
          WHERE equivalencies.cc_course_abv IN
                (SELECT cc_courses.abv
                FROM cc_courses
                WHERE cc_courses.cc_abv IN
                      (SELECT community_colleges.abv
                      FROM community_colleges
                      WHERE community_colleges.community_college = '$user_cc'))
                AND equivalencies.uni_course_abv IN
                      (SELECT degree_req.uni_course_abv
                      FROM degree_req
                      WHERE degree_req.major_abv IN
                            (SELECT majors.abv
                            FROM majors
                            WHERE majors.major = '$user_major'
                            AND majors.university = '$user_uni')
                      AND degree_req.cat1 = '$rowMajorCategory[$i]'
                      OR degree_req.cat2 = '$rowMajorCategory[$i]'
                      OR degree_req.cat3 = '$rowMajorCategory[$i]'
                      OR degree_req.cat4 = '$rowMajorCategory[$i]'
                      AND degree_req.cat1 IS NOT NULL
                      AND degree_req.cat2 IS NOT NULL
                      AND degree_req.cat3 IS NOT NULL
                      AND degree_req.cat4 IS NOT NULL)
          ORDER BY cc_courses.course_number;");

  $numMajorElectiveCourses[$i] = $queryMajorCourseByCategory[$i]->rowcount();
}

/*#########################################
              DATA FOR CHARTJS
##########################################*/

$queryCreditHours = $db -> query("SELECT credit_hours FROM majors WHERE major = '$user_major' and university = '$user_uni';");
// $queryCreditHours = $db -> query("SELECT credit_hours FROM majors WHERE major = 'Computer Science' and university = 'DePaul university';");

while($temp = $queryCreditHours->fetch()){
  $credits = $temp[0];
}

// echo $credits;
// echo $user_uni;
// echo $user_major;

?>
