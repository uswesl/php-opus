var jsf = require('json-schema-faker');
var chalk = require('chalk');

function syntaxHighlight(json) {
  var callbacks = {};
  callbacks['number']  = chalk.blue;
  callbacks['key']     = chalk.yellow;
  callbacks['string']  = chalk.red;
  callbacks['boolean'] = chalk.blue;
  callbacks['null']    = chalk.blue;

  if (typeof json != 'string') {
        json = JSON.stringify(json, undefined, 2);
  }
  json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
      var cls = 'number';
      if (/^"/.test(match)) {
          if (/:$/.test(match)) {
              cls = 'key';
          } else {
              cls = 'string';
          }
      } else if (/true|false/.test(match)) {
          cls = 'boolean';
      } else if (/null/.test(match)) {
          cls = 'null';
      }
      return callbacks[cls](match);
  });
}

var args = process.argv.slice(2);

var schema = require(args[0]);
var sample = jsf(schema);

console.log(syntaxHighlight(sample));
