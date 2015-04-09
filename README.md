# PHPArrayToPlist

Cette petite librairie PHP permet de convertir un array au format Plist.

Version 0.1

# Pré-requis

- PHP >= 5.2
- Extension libxml >= 2.6.0

# Installation

1. Télécharge.
2. Fais une include dans ton code.
3. Profite des joies du XML... Alors que tu pourrais faire du JSON.

# Exemple et Usage

### Tableau PHP d'exemple

```php
$array = array(
	'name' => 'Marceau',
	'age' => '23',
	'likes' => array(
		'PHP', 'Japan', 'Beer', 'Video Games'
	),
	'articles' => array(
		array(
			'id' => 1,
			'name' => 'lorem'
		),
		array(
			'id' => 2,
			'name' => 'ipsum'
		)
	)
);
```

### Code PHP d'utilisation

```php
$plist  = new PHPArrayToPlist;
$output = $plist->set($array)->xml();
```

### Retourne

```xml
<plist version="1.0">
	<dict>
		<key>name</key>
		<string>Marceau</string>
		<key>age</key>
		<integer>23</integer>
		<key>likes</key>
		<array>
			<string>PHP</string>
			<string>Japan</string>
			<string>Beer</string>
			<string>Video Games</string>
		</array>
		<key>articles</key>
		<array>
			<dict>
				<key>id</key>
				<integer>1</integer>
				<key>name</key>
				<string>lorem</string>
			</dict>
			<dict>
				<key>id</key>
				<integer>2</integer>
				<key>name</key>
				<string>ipsum</string>
			</dict>
		</array>
	</dict>
</plist>
```

# Licence

WTFPL - Do What The Fuck You Want To Public License.

DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE Version 2, December 2004

Copyright (C) 2004 Sam Hocevar sam@hocevar.net

Everyone is permitted to copy and distribute verbatim or modified copies of this license document, and changing it is allowed as long as the name is changed.

DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION

You just DO WHAT THE FUCK YOU WANT TO.