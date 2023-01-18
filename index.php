<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Day | REST API</title>
</head>

<body>
    <?php

    require_once('src/Serializer.php');
    require_once('src/JSONSerializer.php');
    require_once('src/XMLSerializer.php');
    require_once('src/Format.php');

    $format = Format::fromString($_GET['format'] ?? 'json') ?? Format::JSON;
    $serializer = $format->getSerializer();

    function arrayContainsIgnoreCaseAndInterpunction($array, $string)
    {
        foreach ($array as $value) {
            if (strcasecmp($value, $string) == 0) {
                return true;
            }
        }
        return false;
    }

    function sendData($names, $day, $month)
    {
        $data = [
            "names" => $names,
            "day" => $day,
            "month" => $month
        ];
        echo htmlspecialchars($GLOBALS["serializer"]->serialize($data), ENT_QUOTES, 'UTF-8');
    }

    function sendError($message)
    {
        $data = [
            "error" => $message
        ];
        echo $GLOBALS["serializer"]->serialize($data);
    }

    function handle()
    {
        $json = file_get_contents('data.json');
        $data = json_decode($json, true);

        if (isset($_GET['name'])) {
            $name = $_GET['name'];

            foreach ($data as $month => $days) {
                foreach ($days as $day => $dayNames) {
                    if (arrayContainsIgnoreCaseAndInterpunction($dayNames, $name)) {
                        sendData($dayNames, $day, $month);
                        return;
                    }
                }
            }

        } else if (isset($_GET['day']) && isset($_GET['month'])) {
            $day = $_GET['day'];
            $month = $_GET['month'];

            if (isset($data[$month]) && isset($data[$month][$day])) {
                sendData($data[$month][$day], $day, $month);
                return;
            }
        }

        sendError("Invalid parameters");
    }

    handle();

    ?>
</body>

</html>