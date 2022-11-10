<?php

class ReadCSV
{
    protected $file;

    /**
     * CSV file required
     * @param csv file
     */
    function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * this method to insert csv data to database
     * دالة رفع مجموعة طلاب باستخدام ملف الاكسل
     */
    function saveToDatabase()
    {
        $conn  = databaseConnect();

        if (($handle = fopen($this->file, "r")) !== FALSE) {

            fgetcsv($handle); // remove first line

            $csvData = []; // init array

            // read csv rows data and add them to $csvData array
            while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
                $csvData[] = [
                    'student_id'            =>      $data[0],
                    'student_name'          =>      $data[1],
                    'student_father_name'   =>      $data[2],
                    'student_grade'         =>      $data[3],
                    'student_image'         =>      $data[4],
                    'student_birth'         =>      $data[5],
                    'student_email'         =>      $data[6],
                    'student_number'        =>      $data[7],
                    'student_parent_number' =>      $data[8],
                    'student_address'       =>      $data[9],
                ];
            }

            fclose($handle);

            $sql = "INSERT INTO `students` (`student_id`,`student_name`,`student_father_name`,`student_grade`,`student_image`,`student_birth`,`student_email`,`student_number`,`student_parent_number`,`student_address`) VALUES ";

            foreach ($csvData as $student) {

                $student_id = $student['student_id'];
                $student_name = $student['student_name'];
                $student_father_name = $student['student_father_name'];
                $student_grade = $student['student_grade'];
                $student_image = $student['student_image'];
                $student_birth = $student['student_birth'];
                $student_email = $student['student_email'];
                $student_number = $student['student_number'];
                $student_parent_number = $student['student_parent_number'];
                $student_address = $student['student_address'];

                $sql .= "(
                    '$student_id',
                    '$student_name',
                    '$student_father_name',
                    '$student_grade',
                    '$student_image',
                    '$student_birth',
                    '$student_email',
                    '$student_number',
                    '$student_parent_number',
                    '$student_address'), ";
            }

            $sql = rtrim($sql, ", "); // remove last , for sql execution 

            if ($conn->query($sql) === TRUE) {
                echo
                '<div class="alert alert-success" role="alert">
                    تم رفع اسماء الطلاب بنجاح
                </div>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
            
        }
    }
}
