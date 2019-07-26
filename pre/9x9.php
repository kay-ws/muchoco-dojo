<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
        <style>
            .dividable2 {
                background-color: gray;
            }
        </style>
        <?php
        function get_string_row_header($value) {
            return '<th>' . $value . '</th>';
        }
        function get_string_col_header($value) {
            return '<th>' . $value . '</th>';
        }
        function get_string_cell($value) {
            if ($value % 2 == 0) {
                return '<td class="dividable2">' . $value . '</td>';
            } else {
                return '<td>' . $value . '</td>';
            }
        }
        ?>
    </head>
    <body>
        <table border="1">
            <thead>
                <?php
                echo '<tr>';
                echo get_string_row_header("&nbsp;");

                for ($col=1; $col<10; $col++) {
                    echo get_string_col_header($col);
                }
                echo '</tr>'
                ?>                    
            </thead>
            <tbody>
                <?php
                for ($row=1; $row<10; $row++) {
                    echo '<tr>';
                    echo get_string_row_header($row);
                    
                    for ($col=1; $col<10; $col++) {
                        $by = $row * $col;
                        echo get_string_cell($by);
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
