Chaincoin Proposal Generator
=================

http://www.chaincoin.org

## How to install
`git clone https://github.com/jayanh/proposal.git proposal`

## Start
1. Enter the folder proposal
2. Use the command `composer install`, to install chaincoin/php-api;
To install composer: 
 - sudo apt-get install curl php5-cli git
 - curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
 
3. Update the file vendor/chaincoin/php-api/settings.php with the ip, port, user e password of your rpc-wallet;
  example: 
  'host' => "127.0.0.1",
  'port' => "21995",
  'user' => "user",
  'pass' => "password"
4. start service: under proposal folder
   php -S xxx.xxx.xx.xxxx:3000 ( xxx is ip and 3000 is port, you can change the port)

## Notes
You'll need some web server (apache/nginx), or you can use php buil-in server


If you would like to contribute feel free to do so! If you have any questions you can find us on the Chaincoin Discord at https://discord.gg/NabdcJ7
