# Keyhole-RDP-VNC

A web service that detects VNC/RDP Servers from shodan using PHP and fetches data through python.

## Installation

```
Php/Mysql
Python 3 for the script
shodan_api_key replace with your api key | fetch.py
pip install shodan mysql
```

## Usage

```
   Run fetch.py to import data from shodan to mysql database
   Configure your db settings in api/config/database.php
   Run with Lamp Stack
```


## Example: 
![alt text](https://raw.githubusercontent.com/codesceptre/Keyhole-VNC-RDP/master/keyhole.png)


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[GNU]()
