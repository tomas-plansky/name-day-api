# Name Day | REST API

A simple PHP name day REST API, that allows users to retrieve name day information by sending GET requests to specific endpoints. It returns the data in JSON or XML format.

> **Author:** Tomáš Plánský

## Usage

This API can accept either a date or a name as input, and returns a list of names with their corresponding name day date.

## Parameters

The parameters are passed to the API via the URL. The parameters are separated by the `&` character. The following parameters are available:

**NOTE:** You either choose `&name` OR `&day`, `&month` as each one is used to get the other one.

### &format (optional)

You can choose one of the following formats, in which the API will then return the requested data.

- JSON (default)
- XML

### &name

If you want to get the date (and more) of the name day of a specific name, use the name parameter. The API will then find the name day date of the given name. (Only Czech names are supported.)

### &day, &month

If you want to do the opposite of what `&name` does (get the names, having the name day on a specific date), you can input the day and month of that name day.

## Example Inputs:
- `http://localhost/name-day-api/?day=1&month=1` - Returns data about 1st of January.
- `http://localhost/name-day-api/?name=Jan` - Returns data about *Jan*'s name day.
- `http://localhost/name-day-api/?format=XML&name=Tomáš` - Returns data about *Tomáš*'s name day in the XML format.

## Example Outputs:

Data about 7th of June - The name day of Iveta and Slavoj.

> URL: `http://localhost/name-day-api/?day=7&month=6`

#### JSON:
```json
{
    "names": ["Iveta", "Slavoj"],
    "day": "7",
    "month": "6"
}
```

#### XML:
```xml
<data>
    <names>
        <item0>Iveta</item0>
        <item1>Slavoj</item1>
    </names>
    <day>7</day>
    <month>6</month>
</data>
```