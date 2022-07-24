<!DOCTYPE html>

<head>
    <style>
        table,
        td {
            border: 1px solid #333;
        }

        thead,
        tfoot {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php

    // fonction d'implementation 
    function foo(array $entry)
    {
        usort($entry, function ($a, $b) {
            if ($a[0] == $b[0]) {
                return 0;
            }
            return ($a[0] < $b[0]) ? -1 : 1;
        });

        $unions = [];
        $current = [];

        foreach ($entry as $interval) {
            if (!$current) {
                $current = $interval;
            } elseif ($current[1] >= $interval[0]) {
                $current[1] = $interval[1] > $current[1] ? $interval[1] : $current[1];
            } else {
                $unions[] = $current;
                $current = $interval;
            }
        }

        if ($current)
            $unions[] = $current;

        return $unions;
    }


    //jeux de données
    function getData()
    {
        return [
            [[0, 3], [6, 10]],
            [[0, 5], [3, 10]],
            [[0, 5], [2, 4]],
            [[7, 8], [3, 6], [2, 4]],
            [[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]]
        ];
    }


    // fonction d'affichage
    function init()
    {

        $data = getData();

        $out = "<table ><thead><tr><th>Entrer</th><th>sortie</th></tr></thead><tbody>";
        foreach ($data as $entry) {
            $out .= "<tr><td>" . json_encode($entry) . "</td><td>" . json_encode(foo($entry)) . "</td></tr>";
        }

        $out .= "</tbody></table>";

        echo $out;
    }

    init();

    ?>
</body>

</html>