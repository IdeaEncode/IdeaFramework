# IdeaEncode

Idea Encode website


#IdeaFramework - configuration
To use Idea routing globally you must redirect all calls to your index.php with your web server
consider that you need to set the `IDEA_WED_SERVER` on your config file.
Default value is set to `standalone` <br>
If you are using apache you must install `XSendFile` mod and add `XSendFile On` in your `<directory>`
section on apache vhosts configuration <br>
if no `IDEA_WED_SERVER` is setted or you don't have XSendFile installed on apache IdeaFramework will
start in standalone mode and will serve all files using php