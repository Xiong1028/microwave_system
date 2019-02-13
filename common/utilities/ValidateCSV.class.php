<?php
/*
 *  Purpose: a class to validate csv files before insert data into databases
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Date:   Feb 9, 2019
**/

class ValidateCSV
{
    private $errors_arr=array();
    private $path_wide_arr;
    private $path_endPoints_arr;
    private $path_midPoints_arr;
    public static $ter_allowedType_arrs = array("Grassland", "Rough Grassland", "Smooth rock", "Bare soil", "Paved Surface", "Lake", "Ocean", "Rough rock");
    public static $obstr_allowedType_arrs = array("None", "Trees", "Brush", "Building", "Webbed Towers", "Solid Towers", "Power Cables");

    public function __construct($csvArr)
    {
        $this->path_wide_arr = array_slice($csvArr, 0, 1);
        $this->path_endPoints_arr = array_slice($csvArr, 1, 2);
        $this->path_midPoints_arr = array_slice($csvArr, 3, 14);
    }

    //a method to validate data of table1 path_wide
    public function validateTable1()
    {
        for ($i = 0; $i < count($this->path_wide_arr[0]) - 1; $i++) {
            switch ($i) {
                case 0:

                    if (empty($this->path_wide_arr[0][$i]) || !isset($this->path_wide_arr[0][$i])) {
                        $this->errors_arr['path01']['path_name'] = "The path_name cannot be empty";
                    } else if (strlen($this->path_wide_arr[0][$i]) > 100) {
                        $this->errors_arr['path01']['path_name'] = "The length of path_name must be less than 100";
                    }
                    break;
                case 1:
                    if (empty($this->path_wide_arr[0][$i]) || !isset($this->path_wide_arr[0][$i])) {
                        $this->errors_arr['path01']['path_length'] = "The path_length cannot be empty";
                    } else if ($this->path_wide_arr[0][$i] < 1 || $this->path_wide_arr[0][$i] > 100) {
                        $this->errors_arr['path01']['path_length'] = "The frequency of path must be between 1 and 100";
                    }
                    break;
                case 2:
                    if (empty($this->path_wide_arr[0][$i]) || !isset($this->path_wide_arr[0][$i])) {
                        $this->errors_arr['path01']['description'] = "The description cannot be empty";
                    } else if (strlen($this->path_wide_arr[0][$i]) > 255) {
                        $this->errors_arr['path01']['description'] = "the length of description must be less than 255";
                    }
                    break;
                case 3:
                    if (strlen($this->path_wide_arr[0][$i]) > 65534) {
                        $this->errors_arr['path01']['note'] = "the length of note must be less 65534";
                    }
                    break;
                default:
                    return;
            }

        }
    }

//a method to validate data of table2 path_endPoints
    public function validateTable2()
    {
        for ($i = 0; $i < count($this->path_endPoints_arr); $i++) {
            for ($j = 0; $j < count($this->path_endPoints_arr[0]) - 2; $j++) {
                switch ($j) {
                    case 0:
                        if (empty($this->path_endPoints_arr[$i][$j]) && $this->path_endPoints_arr[$i][$j] != 0) {
                            $this->errors_arr['path02'][$i]['dist_from_start'] = "The distance from start of the endPoint cannot be empty";
                        } else if ($this->path_endPoints_arr[$i][$j] > 100 || $this->path_endPoints_arr[$i][$j] < 0) {
                            $this->errors_arr['path02'][$i]['dist_from_strat'] = "The distance from start of the endPoint must be less than 100 or greater than 0";
                        }
                        break;
                    case 1:
                        if (empty($this->path_endPoints_arr[$i][$j]) && $this->path_endPoints_arr[$i][$j] != 0) {
                            $this->errors_arr['path02'][$i]['grd_height'] = "The Ground height cannot be empty";
                        } else if ($this->path_endPoints_arr[$i][$j] > 100 || $this->path_endPoints_arr[$i][$j] < 0) {
                            $this->errors_arr['path02'][$i]['grd_height'] = "The Ground height must be less than 100 or greater than 0";
                        }
                        break;
                    case 2:
                        if (empty($this->path_endPoints_arr[$i][$j]) && $this->path_endPoints_arr[$i][$j] != 0) {
                            $this->errors_arr['path02'][$i]['atn_height'] = "The Antenna height cannot be empty";
                        } else if ($this->path_endPoints_arr[$i][$j] > 100 || $this->path_endPoints_arr[$i][$j] < 0) {
                            $this->errors_arr['path02'][$i]['atn_height'] = "The Antenna height must be less than 100 or greater than 0";
                        }
                        break;
                    default:
                        return;
                }
            }
        }
    }

//a method to validate data of table3 path_midPoints
    public function validateTable3()
    {
        for ($i = 0; $i < count($this->path_midPoints_arr); $i++) {
            for ($j = 0; $j < count($this->path_endPoints_arr[0]); $j++) {
                switch ($j) {
                    case 0:
                        if (!isset($this->path_midPoints_arr[$i][$j]) || empty($this->path_midPoints_arr[$i][$j])) {
                            $this->errors_arr['path03'][$i]['dist_from_start'] = 'The distance from start of the midPoint cannot be empty';
                        } elseif ($this->path_midPoints_arr[$i][$j] > 100 || $this->path_midPoints_arr[$i][$j] < 0) {
                            $this->errors_arr['path03'][$i]['dist_from_start'] = 'The distance from start of the midPoint must be less than 100 or greater than 0';
                        }
                        break;
                    case 1:
                        if (!isset($this->path_midPoints_arr[$i][$j]) || empty($this->path_midPoints_arr[$i][$j])) {
                            $this->errors_arr['path03'][$i]['grd_height'] = 'The Ground height of the midPoint cannot be empty';
                        } elseif ($this->path_midPoints_arr[$i][$j] > 100 || $this->path_midPoints_arr[$i][$j] < 0) {
                            $this->errors_arr['path03'][$i]['grd_height'] = 'The Ground height of the midPoint must be less than 100 or greater than 0';
                        }
                        break;
                    case 2:
                        if (!isset($this->path_midPoints_arr[$i][$j]) || empty($this->path_midPoints_arr[$i][$j])) {
                            $this->errors_arr['path03'][$i]['trn_type'] = 'The terrain type cannot be empty';
                        } elseif (!in_array($this->path_midPoints_arr[$i][$j], ValidateCSV::$ter_allowedType_arrs, false)) {
                            $this->errors_arr['path03'][$i]['trn_type'] = 'The terrain type is invalid';
                        }
                        break;
                    case 3:
                        if (!isset($this->path_midPoints_arr[$i][$j]) || (empty($this->path_midPoints_arr[$i][$j]) && $this->path_midPoints_arr[$i][$j] != 0)) {
                            $this->errors_arr['path03'][$i]['obstr_height'] = 'The obstruction height cannot be empty';
                        } elseif
                        ($this->path_midPoints_arr[$i][$j] > 100 || $this->path_midPoints_arr[$i][$j] < 0) {
                            $this->errors_arr['path03'][$i]['obstr_height'] = 'The obstruction height must be less than 100 or greater than or equal to 0';
                        }
                        break;
                    case 4:
                        if ($this->path_midPoints_arr[$i][$j] != 0 || empty($this->path_midPoints_arr[$i][$j])) {
                            $this->errors_arr['path03'][$i]['obstr_type'] = 'The obstruction height cannot be empty';
                        } elseif (!in_array($this->path_midPoints_arr[$i][$j], ValidateCSV::$obstr_allowedType_arrs, false)) {
                            $this->errors_arr['path03'][$i]['obstr_type'] = 'The obstruction type is invalid';
                        }
                        break;
                    default:
                        return;
                }
            }
        }
    }

    public function get_errors_arr()
    {
        $this->validateTable1();
        $this->validateTable2();
        $this->validateTable3();

        return $this->errors_arr;
    }

    public function get_path_wide()
    {
        return $this->path_wide_arr;
    }

    public function get_path_endPoints()
    {
        return $this->path_endPoints_arr;
    }

    public function get_path_midPoints()
    {
        return $this->path_midPoints_arr;
    }
}

?>