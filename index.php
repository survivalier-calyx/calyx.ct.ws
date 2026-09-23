<?php
$path=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH) ?? '/';
$path=rtrim($path,'/') ?: '/';
$pages=[
'/' => ['Calyx — langage simple et modulaire','home'],
'/install' => ['Installer Calyx','install'],
'/learn' => ['Apprendre Calyx','learn'],
'/learn/language'=>['Langage Calyx','language'],
'/learn/sys'=>['Module sys','sys'],
'/learn/color'=>['Module color','color'],
'/learn/math'=>['Module math','math'],
'/learn/random'=>['Module random','random'],
'/learn/fs'=>['Module fs','fs'],
'/learn/webserver'=>['Module webserver','webserver'],
'/learn/modules'=>['Système de modules','modules'],
'/learn/technical'=>['Architecture technique','technical'],
'/docs'=>['Documentation technique','docs'],
];
if(isset($_GET['source'])){ $f=__DIR__.'/download/files/'.basename($_GET['source']); if(is_file($f)){header('Content-Type:text/plain; charset=utf-8');readfile($f);exit;}}
if(!isset($pages[$path])){http_response_code(404);$title='404';$view='404';}else[$title,$view]=$pages[$path];
function h($s){return htmlspecialchars($s,ENT_QUOTES,'UTF-8');}
function nav($active){$items=['/'=>'Accueil','/install'=>'Installer','/learn'=>'Apprendre','/docs'=>'Documentation'];echo '<nav class="nav"><div class="navin"><a class="brand" href="/"><img src="/assets/logo.svg">Calyx</a><div class="links">';foreach($items as $u=>$n)echo '<a class="'.($active==$u?'active':'').'" href="'.$u.'">'.$n.'</a>';echo '</div><div class="spacer"></div><a class="github" href="https://github.com/survivalier-calyx">GitHub</a><a class="download" href="/install">Installer</a></div></nav>';}
function layout($title,$view,$content){nav($view=='home'?'/':($view=='install'?'/install':($view=='learn'?'/learn':'/docs')));echo '<main>'.$content.'</main><footer class="footer"><div class="wrap">Calyx 1.0.3 · langage simple et modulaire · Python 3.8+ · Linux · macOS · Windows</div></footer>';}
function code($s){echo '<pre class="code">'.h(trim($s)).'</pre>';}
ob_start();
if($view==='home'){?>
<section class="hero"><div class="wrap hero-grid"><div><span class="eyebrow"><i class="dot"></i> Calyx 1.0.3</span><h1>Un langage.<br>Simple. Modulaire.</h1><p>Calyx est un langage de programmation lisible et léger, conçu pour écrire rapidement des scripts, des outils et de petits serveurs web.</p><div class="actions"><a class="btn primary" href="/install">Télécharger Calyx</a><a class="btn" href="/learn">Commencer à apprendre →</a><img src="https://survivalier.fast-page.org/badge.svg"></div></div><div class="terminal"><div class="termbar"><i></i><i></i><i></i></div><span class="muted">$</span> calyx hello.cx<br><br><span class="green">Bonjour depuis Calyx !</span><br><span class="muted">runtime:</span> Calyx 1.0.3<br><span class="muted">platform:</span> Linux<br><br><span class="blue">ready.</span></div></div></section>
<section class="section"><div class="wrap"><h2>Pourquoi Calyx ?</h2><p class="lead">Une syntaxe volontairement compacte, un interpréteur Python sans dépendance externe et des modules intégrés pour couvrir les besoins courants.</p><div class="cards">
<div class="card"><div class="icon">01</div><h3>Lisible</h3><p>Variables, fonctions, classes, boucles et exceptions avec une syntaxe proche du langage naturel.</p></div>
<div class="card"><div class="icon">02</div><h3>Modulaire</h3><p>Importez vos modules avec <code>use</code> ou utilisez les modules natifs <code>#int/...</code>.</p></div>
<div class="card"><div class="icon">03</div><h3>Portable</h3><p>Le runtime fonctionne sous Linux, macOS et Windows avec Python 3.8+.</p></div>
</div></div></section>
<section class="section"><div class="wrap two"><div><h2>Un langage pensé pour les projets</h2><p class="lead">Calyx possède un REPL, un système de modules, des structures de données, des classes avec héritage et un module webserver intégré.</p><a class="btn" href="/learn/language">Explorer la syntaxe →</a></div><div><?php code(<<<'CX'
use #int/webserver;

let app = webserver.create(8080);

app.get("/", fn(req) {
    return "<h1>Hello Calyx</h1>";
});

app.start();
CX);?></div></div></section>
<?php }elseif($view==='install'){?>
<section class="section"><div class="wrap"><h1> Télécharger Calyx</h1><p class="lead">Calyx 1.0.3 est distribué comme un runtime Python sans dépendance externe.</p><div class="cards"><div class="card"><div class="icon">↓</div><h3>Archive complète</h3><p>Runtime, installateur, licence et exemples.</p><br><a class="btn primary" href="/download/calyx-1.0.3.zip"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><title>zip</title><path fill="currentColor" d="M413.4 0H114.7C91.1 0 72 19.1 72 42.7v426.7c0 23.5 19.1 42.7 42.7 42.7h298.7c23.5 0 42.7-19.1 42.7-42.7V42.7C456 19.1 436.9 0 413.4 0m-192 469.3L242.7 320h42.7l21.3 149.3zM328 128h-64v42.7h64v42.7h-64V256h64v42.7h-64V256h-64v-42.7h64v-42.7h-64V128h64V85.3h-64V42.7h64v42.7h64zm-74.6 277.3L242.7 448h42.7l-10.7-42.7z"/></svg> Télécharger .zip</a><br><br><a class="btn primary" href="https://github.com/survivalier-calyx/calyx-apps/raw/refs/heads/main/Calyx-Installer-x86_64.AppImage"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><title>tux</title><g fill="currentColor"><path d="M8.996 4.497c.104-.076.1-.168.186-.158s.022.102-.098.207c-.12.104-.308.243-.46.323c-.291.152-.631.336-.993.336s-.647-.167-.853-.33c-.102-.082-.186-.162-.248-.221c-.11-.086-.096-.207-.052-.204c.075.01.087.109.134.153c.064.06.144.137.241.214c.195.154.454.304.778.304s.702-.19.932-.32c.13-.073.297-.204.433-.304M7.34 3.781c.055-.02.123-.031.174-.003c.011.006.024.021.02.034c-.012.038-.074.032-.11.05c-.032.017-.057.052-.093.054c-.034 0-.086-.012-.09-.046c-.007-.044.058-.072.1-.089m.581-.003c.05-.028.119-.018.173.003c.041.017.106.045.1.09c-.004.033-.057.046-.09.045c-.036-.002-.062-.037-.093-.053c-.036-.019-.098-.013-.11-.051c-.004-.013.008-.028.02-.034"/><path fill-rule="evenodd" d="M8.446.019c2.521.003 2.38 2.66 2.364 4.093c-.01.939.509 1.574 1.04 2.244c.474.56 1.095 1.38 1.45 2.32c.29.765.402 1.613.115 2.465a.8.8 0 0 1 .254.152l.001.002c.207.175.271.447.329.698c.058.252.112.488.224.615c.344.382.494.667.48.922c-.015.254-.203.43-.435.57c-.465.28-1.164.491-1.586 1.002c-.443.527-.99.83-1.505.871a1.25 1.25 0 0 1-1.256-.716v-.001a1 1 0 0 1-.078-.21c-.67.038-1.252-.165-1.718-.128c-.687.038-1.116.204-1.506.206c-.151.331-.445.547-.808.63c-.5.114-1.126 0-1.743-.324c-.577-.306-1.31-.278-1.85-.39c-.27-.057-.51-.157-.626-.384c-.116-.226-.095-.538.07-.988c.051-.16.012-.398-.026-.648a2.5 2.5 0 0 1-.037-.369c0-.133.022-.265.087-.386v-.002c.14-.266.368-.377.577-.451s.397-.125.53-.258c.143-.15.27-.374.443-.56q.036-.037.073-.07c-.081-.538.007-1.105.192-1.662c.393-1.18 1.223-2.314 1.811-3.014c.502-.713.65-1.287.701-2.016c.042-.997-.705-3.974 2.112-4.2q.168-.015.321-.013m2.596 10.866l-.03.016c-.223.121-.348.337-.427.656c-.08.32-.107.733-.13 1.206v.001c-.023.37-.192.824-.31 1.267s-.176.862-.036 1.128v.002c.226.452.608.636 1.051.601s.947-.304 1.36-.795c.474-.576 1.218-.796 1.638-1.05c.21-.126.324-.242.333-.4c.009-.157-.097-.403-.425-.767c-.17-.192-.217-.462-.274-.71c-.056-.247-.122-.468-.26-.585l-.001-.001c-.18-.157-.356-.17-.565-.164q-.069.001-.14.005c-.239.275-.805.612-1.197.508c-.359-.09-.562-.508-.587-.918m-7.204.03H3.83c-.189.002-.314.09-.44.225c-.149.158-.276.382-.445.56v.002h-.002c-.183.184-.414.239-.61.31c-.195.069-.353.143-.46.35v.002c-.085.155-.066.378-.029.624c.038.245.096.507.018.746v.002l-.001.002c-.157.427-.155.678-.082.822c.074.143.235.22.48.272c.493.103 1.26.069 1.906.41c.583.305 1.168.404 1.598.305c.431-.098.712-.369.75-.867v-.002c.029-.292-.195-.673-.485-1.052c-.29-.38-.633-.752-.795-1.09v-.002l-.61-1.11c-.21-.286-.43-.462-.68-.5a1 1 0 0 0-.106-.008M9.584 4.85c-.14.2-.386.37-.695.467c-.147.048-.302.17-.495.28a1.3 1.3 0 0 1-.74.19a.97.97 0 0 1-.582-.227c-.14-.113-.25-.237-.394-.322a3 3 0 0 1-.192-.126c-.063 1.179-.85 2.658-1.226 3.511a5.4 5.4 0 0 0-.43 1.917c-.68-.906-.184-2.066.081-2.568c.297-.55.343-.701.27-.649c-.266.436-.685 1.13-.848 1.844c-.085.372-.1.749.01 1.097c.11.349.345.67.766.931c.573.351.963.703 1.193 1.015s.302.584.23.777a.4.4 0 0 1-.212.22a.7.7 0 0 1-.307.056l.184.235c.094.124.186.249.266.375c1.179.805 2.567.496 3.568-.218c.1-.342.197-.664.212-.903c.024-.474.05-.896.136-1.245s.244-.634.53-.791a1 1 0 0 1 .138-.061q.005-.045.013-.087c.082-.546.569-.572 1.18-.303c.588.266.81.499.71.814h.13c.122-.398-.133-.69-.822-1.025l-.137-.06a2.35 2.35 0 0 0-.012-1.113c-.188-.79-.704-1.49-1.098-1.838c-.072-.003-.065.06.081.203c.363.333 1.156 1.532.727 2.644a1.2 1.2 0 0 0-.342-.043c-.164-.907-.543-1.66-.735-2.014c-.359-.668-.918-2.036-1.158-2.983M7.72 3.503a1 1 0 0 0-.312.053c-.268.093-.447.286-.559.391c-.022.021-.05.04-.119.091s-.172.126-.321.238q-.198.151-.13.38c.046.15.192.325.459.476c.166.098.28.23.41.334a1 1 0 0 0 .215.133a.9.9 0 0 0 .298.066c.282.017.49-.068.673-.173s.34-.233.518-.29c.365-.115.627-.345.709-.564a.37.37 0 0 0-.01-.309c-.048-.096-.148-.187-.318-.257h-.001c-.354-.151-.507-.162-.705-.29c-.321-.207-.587-.28-.807-.279m-.89-1.122h-.025a.4.4 0 0 0-.278.135a.76.76 0 0 0-.191.334a1.2 1.2 0 0 0-.051.445v.001c.01.162.041.299.102.436c.05.116.109.204.183.274l.089-.065l.117-.09l-.023-.018a.4.4 0 0 1-.11-.161a.7.7 0 0 1-.054-.22v-.01a.7.7 0 0 1 .014-.234a.4.4 0 0 1 .08-.179q.056-.069.126-.073h.013a.18.18 0 0 1 .123.05c.045.04.08.09.11.162a.7.7 0 0 1 .054.22v.01a.7.7 0 0 1-.002.17a1.1 1.1 0 0 1 .317-.143a1.3 1.3 0 0 0 .002-.194V3.23a1.2 1.2 0 0 0-.102-.437a.8.8 0 0 0-.227-.31a.4.4 0 0 0-.268-.102m1.95-.155a.63.63 0 0 0-.394.14a.9.9 0 0 0-.287.376a1.2 1.2 0 0 0-.1.51v.015q0 .079.01.152c.114.027.278.074.406.138a1 1 0 0 1-.011-.172a.8.8 0 0 1 .058-.278a.5.5 0 0 1 .139-.2a.26.26 0 0 1 .182-.069a.26.26 0 0 1 .178.081c.055.054.094.12.124.21c.029.086.042.17.04.27l-.002.012a.8.8 0 0 1-.057.277c-.024.059-.089.106-.122.145c.046.016.09.03.146.052a5 5 0 0 1 .248.102a1.2 1.2 0 0 0 .244-.763a1.2 1.2 0 0 0-.11-.495a.9.9 0 0 0-.294-.37a.64.64 0 0 0-.39-.133z"/></g></svg> Télécharger .AppImage</a><br><br><a class="btn primary" href="https://github.com/survivalier-calyx/calyx-apps/raw/refs/heads/main/Calyx-Installer.exe"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 12 12"><title>windows</title><path fill="currentColor" d="M6 6h5V1H6Zm-6 6h5V7H0Zm0-6h5V1H0Zm6 6h5V7H6Zm0 0"/></svg> Télécharger .exe</a></div><div class="card"><div class="icon">Py</div><h3>Runtime</h3><p>Le fichier principal est <code>calyx.py</code>. Python 3.8 ou plus récent est requis.</p><br><a class="btn" href="/download/files/calyx.py">Voir le code</a></div><div class="card"><div class="icon">✓</div><h3>Installation</h3><p>Un installateur graphique et une version CLI sont inclus.</p><br><a class="btn" href="/download/files/installer.py">Installer.py</a></div></div>
<div class="notice" style="margin-top:30px"><h2>Démarrage rapide</h2><?php code("python3 installer.py\ncalyx hello.cx\ncalyx\ncalyx modules\ncalyx install monmodule.cx");?></div></div></section>
<?php }elseif(in_array($view,['learn','docs'])){?>
<section class="section"><div class="wrap"><h1><?= $view==='learn'?'Apprendre Calyx':'Documentation technique' ?></h1><p class="lead"><?= $view==='learn'?'Parcourez les fondamentaux puis les modules natifs. Chaque page contient des exemples directement exécutables.':'Référence technique de l’implémentation, de la syntaxe et des modules intégrés de Calyx 1.0.3.' ?></p><div class="cards">
<a class="card" href="/learn/language"><div class="icon">{} </div><h3>Langage</h3><p>Variables, fonctions, conditions, boucles, collections, classes et erreurs.</p></a>
<a class="card" href="/learn/modules"><div class="icon">M</div><h3>Modules</h3><p>Importer, créer et installer des modules Calyx.</p></a>
<a class="card" href="/learn/webserver"><div class="icon">W</div><h3>Webserver</h3><p>Créer des routes HTTP, JSON, fichiers statiques et serveurs.</p></a>
<a class="card" href="/learn/color"><div class="icon">C</div><h3>Color</h3><p>Couleurs ANSI, styles et sorties terminal.</p></a>
<a class="card" href="/learn/sys"><div class="icon">S</div><h3>Sys</h3><p>Système, environnement, date, heure et exécution de commandes.</p></a>
<a class="card" href="/learn/technical"><div class="icon">T</div><h3>Architecture</h3><p>Lexer, parser, AST, environnement et interpréteur.</p></a>
</div></div></section>
<?php }elseif($view==='language'){?>
<section class="layout"><aside class="side"><h4>Langage</h4><a class="sel" href="/learn/language">Syntaxe</a><a href="/learn/modules">Modules</a><h4>Modules natifs</h4><a href="/learn/sys">sys</a><a href="/learn/color">color</a><a href="/learn/webserver">webserver</a></aside><article class="doc"><h1>Le langage Calyx</h1><p>Les programmes Calyx utilisent l’extension <code>.cx</code>. Les instructions sont généralement terminées par <code>;</code> et les blocs sont délimités par <code>{ }</code>.</p><h2>Variables et constantes</h2><?php code('let nom = "Ada";\nlet age = 36;\nconst PI = 3.14159;');?></article></section>
<section class="section"><div class="wrap"><div class="two"><div><h2>Fonctions</h2><?php code('fn add(a, b = 1) {\n    return a + b;\n}\nprint(add(4, 3));');?></div><div><h2>Conditions et boucles</h2><?php code('if age >= 18 {\n    print("majeur");\n} else {\n    print("mineur");\n}\nfor item in liste {\n    print(item);\n}');?></div></div><div class="two"><div><h2>Collections</h2><?php code('let nombres = [1, 2, 3];\nlet user = { nom: "Ada" };\nuser.age = 36;');?></div><div><h2>Classes</h2><?php code('class Animal {\n    fn init(nom) { self.nom = nom; }\n}\nclass Chien extends Animal { ... }');?></div></div><h2>Interpolation</h2><?php code('let nom = "Calyx";\nprint("Bonjour ${nom} !");\nprint(\'Texte brut\');');?></div></section>
<?php }elseif($view==='technical'){?>
<section class="layout"><aside class="side"><h4>Technique</h4><a class="sel" href="/learn/technical">Architecture</a><a href="/learn/modules">Modules</a></aside><article class="doc"><h1>Architecture technique</h1><p>Calyx 1.0.3 est implémenté dans un fichier Python principal. L’exécution suit une chaîne lexer → parser → interpréteur.</p><h2>1. Analyse lexicale</h2><p>La fonction <code>tokenize()</code> transforme le texte source en tokens : nombres, identifiants, mots-clés, chaînes, chemins de modules et opérateurs. Les commentaires <code>//</code> et <code>/* */</code> sont ignorés.</p><h2>2. Analyse syntaxique</h2><p>La classe <code>Parser</code> consomme les tokens et construit des nœuds sous forme de tuples. Elle reconnaît les déclarations, expressions, blocs, fonctions, classes, conditions, boucles, exceptions et imports.</p><h2>3. Interpréteur</h2><p>La classe <code>Interpreter</code> évalue les nœuds dans des environnements (<code>Env</code>). Les flux <code>return</code>, <code>break</code> et <code>continue</code> sont transportés par des exceptions internes.</p><h2>4. Modules natifs</h2><p>Le dictionnaire <code>NATIVE</code> associe les noms de modules à leurs fabriques Python : <code>sys</code>, <code>color</code>, <code>webserver</code>, <code>math</code>, <code>random</code>, <code>fs</code> et <code>json</code>.</p><?php code('NATIVE = {\n    "sys": make_sys,\n    "color": make_color,\n    "webserver": make_webserver,\n    "math": make_math,\n    "random": make_random,\n    "fs": make_fs,\n    "json": make_json,\n}');?></article></section>
<?php }elseif($view==='modules'){?>
<section class="section"><div class="wrap"><h1>Système de modules</h1><p class="lead">Les modules rendent les programmes Calyx réutilisables. Le chemin <code>use</code> peut viser un module local ou un module natif.</p><div class="callout"><b>Ordre de recherche :</b> dossier du script, <code>./modules/</code>, puis dossier universel des modules.</div><?php code('use test;\nuse libs/outils;\nuse test as t;\nuse #int/sys;\nuse #int/webserver;');?></div></section>
<?php }elseif(in_array($view,['sys','color','math','random','fs','json','webserver'])){ $info=[
'sys'=>['Système','use #int/sys;',[
['os','Nom du système d’exploitation détecté, par exemple linux, windows ou macos.'],
['arch','Architecture matérielle détectée par Python, par exemple x86_64 ou arm64.'],
['sep','Séparateur de chemins utilisé par le système, comme / ou \\.'],
['args','Liste des arguments passés au script Calyx.'],
['calyx_version','Version du runtime Calyx actuellement exécuté.'],
['os_version()','Retourne une description de la plateforme et de sa version.'],
['time()','Retourne l’heure actuelle au format HH:MM:SS.'],
['date()','Retourne la date actuelle au format YYYY-MM-DD.'],
['datetime(fmt)','Retourne la date et l’heure actuelles selon le format fourni. Le format par défaut est YYYY-MM-DD HH:MM:SS.'],
['now()','Retourne un objet contenant année, mois, jour, heure, minute, seconde et jour de la semaine.'],
['timestamp()','Retourne le timestamp Unix actuel.'],
['env(name, default)','Lit une variable d’environnement. Retourne la valeur par défaut si elle n’existe pas.'],
['cwd','Chemin du répertoire de travail courant.'],
['home()','Retourne le chemin du dossier personnel de l’utilisateur.'],
['hostname','Nom de la machine sur laquelle Calyx s’exécute.'],
['username()','Retourne le nom de l’utilisateur courant.'],
['cpu_count()','Retourne le nombre de processeurs logiques disponibles.'],
['sleep(s)','Met l’exécution en pause pendant s secondes.'],
['exit(code)','Arrête immédiatement le programme avec le code de sortie indiqué.'],
['clear()','Efface le terminal.'],
['run(cmd)','Exécute une commande système et retourne son code de sortie, sa sortie standard et son erreur standard.'],
['modules_dir()','Retourne le dossier utilisé par Calyx pour les modules universels.']
]],
'color'=>['Couleurs du terminal','use #int/color;',[
['black(text)','Affiche text en noir.'],
['red(text)','Affiche text en rouge.'],
['green(text)','Affiche text en vert.'],
['yellow(text)','Affiche text en jaune.'],
['blue(text)','Affiche text en bleu.'],
['magenta(text)','Affiche text en magenta.'],
['cyan(text)','Affiche text en cyan.'],
['white(text)','Affiche text en blanc.'],
['orange(text)','Applique le code ANSI correspondant à orange dans Calyx.'],
['bg_black(text)','Affiche text avec un arrière-plan noir.'],
['bg_red(text)','Affiche text avec un arrière-plan rouge.'],
['bg_green(text)','Affiche text avec un arrière-plan vert.'],
['bg_yellow(text)','Affiche text avec un arrière-plan jaune.'],
['bg_blue(text)','Affiche text avec un arrière-plan bleu.'],
['bg_magenta(text)','Affiche text avec un arrière-plan magenta.'],
['bg_cyan(text)','Affiche text avec un arrière-plan cyan.'],
['bg_white(text)','Affiche text avec un arrière-plan blanc.'],
['bg_orange(text)','Applique le code ANSI d’arrière-plan correspondant à orange dans Calyx.'],
['bright_black(text)','Affiche text avec la variante ANSI bright du noir.'],
['bright_red(text)','Affiche text avec la variante ANSI bright du rouge.'],
['bright_green(text)','Affiche text avec la variante ANSI bright du vert.'],
['bright_yellow(text)','Affiche text avec la variante ANSI bright du jaune.'],
['bright_blue(text)','Affiche text avec la variante ANSI bright du bleu.'],
['bright_magenta(text)','Affiche text avec la variante ANSI bright du magenta.'],
['bright_cyan(text)','Affiche text avec la variante ANSI bright du cyan.'],
['bright_white(text)','Affiche text avec la variante ANSI bright du blanc.'],
['bright_orange(text)','Applique la variante ANSI bright associée à orange dans Calyx.'],
['gray(text)','Affiche text en gris, via le code ANSI bright black.'],
['bold(text)','Affiche text en gras.'],
['dim(text)','Affiche text avec le style dim.'],
['italic(text)','Affiche text en italique lorsque le terminal le prend en charge.'],
['underline(text)','Souligne text.'],
['rgb(text,r,g,b)','Affiche text avec une couleur RGB personnalisée. r, g et b sont les composantes 0–255.'],
['bg_rgb(text,r,g,b)','Affiche text avec un arrière-plan RGB personnalisé. r, g et b sont les composantes 0–255.'],
['strip(text)','Supprime les séquences ANSI de couleur et de style présentes dans text.'],
['ok(text)','Ajoute le préfixe [OK] et affiche le message en vert.'],
['error(text)','Ajoute le préfixe [ERREUR] et affiche le message en rouge.'],
['warn(text)','Ajoute le préfixe [!] et affiche le message en jaune.'],
['info(text)','Ajoute le préfixe [i] et affiche le message en cyan.'],
['enable(flag)','Active ou désactive les couleurs ANSI pour les fonctions du module.']
]],
'math'=>['Mathématiques','use #int/math;',[
['pi','Constante π.'],
['e','Constante mathématique e.'],
['inf','Valeur représentant l’infini positif.'],
['sqrt(x)','Retourne la racine carrée de x. Une erreur Calyx est produite si x est négatif.'],
['pow(a,b)','Retourne a élevé à la puissance b.'],
['floor(x)','Arrondit x vers le bas jusqu’à l’entier inférieur.'],
['ceil(x)','Arrondit x vers le haut jusqu’à l’entier supérieur.'],
['round(x,nd)','Arrondit x avec nd chiffres après la virgule.'],
['abs(x)','Retourne la valeur absolue de x.'],
['sin(x)','Calcule le sinus de x, en radians.'],
['cos(x)','Calcule le cosinus de x, en radians.'],
['tan(x)','Calcule la tangente de x, en radians.'],
['log(x,base)','Calcule le logarithme de x dans la base indiquée, e par défaut.'],
['log10(x)','Calcule le logarithme décimal de x.'],
['exp(x)','Calcule e puissance x.'],
['hypot(a,b)','Retourne l’hypoténuse correspondant aux côtés a et b.'],
['gcd(a,b)','Retourne le plus grand diviseur commun de a et b.']
]],
'random'=>['Aléatoire','use #int/random;',[
['int(a,b)','Retourne un entier aléatoire compris entre a et b, bornes incluses.'],
['float()','Retourne un nombre réel aléatoire compris entre 0 inclus et 1 exclu.'],
['choice(list)','Retourne un élément choisi aléatoirement dans une liste. Une liste vide provoque une erreur.'],
['shuffle(list)','Mélange la liste fournie sur place puis la retourne.'],
['seed(value)','Initialise la graine du générateur pseudo-aléatoire.']
]],
'fs'=>['Fichiers','use #int/fs;',[
['read(path)','Lit un fichier texte en UTF-8 et retourne son contenu.'],
['write(path,text)','Écrit text dans le fichier path en remplaçant son contenu.'],
['append(path,text)','Ajoute text à la fin du fichier path.'],
['exists(path)','Indique si le chemin existe.'],
['is_file(path)','Indique si le chemin désigne un fichier.'],
['is_dir(path)','Indique si le chemin désigne un dossier.'],
['list(path=".")','Retourne la liste triée des éléments présents dans le dossier.'],
['mkdir(path)','Crée le dossier et ses parents nécessaires s’ils n’existent pas.'],
['remove(path)','Supprime un fichier ou un dossier avec son contenu.'],
['copy(src,dst)','Copie src vers dst.'],
['join(...)','Assemble plusieurs morceaux de chemin avec le séparateur du système.'],
['basename(path)','Retourne le dernier composant du chemin.'],
['dirname(path)','Retourne le dossier parent du chemin.'],
['abspath(path)','Retourne le chemin absolu correspondant à path.'],
['sep','Séparateur de chemins du système.']
]],
'json'=>['JSON','use #int/json;',[
['parse(text)','Convertit une chaîne JSON en valeur Calyx. Une erreur Calyx est produite si le JSON est invalide.'],
['stringify(value,indent)','Convertit une valeur Calyx en texte JSON. indent permet de produire un JSON indenté.']
]],
'webserver'=>['Serveur HTTP','use #int/webserver;',[
['create(port)','Crée une application HTTP et définit son port par défaut.'],
['json(data,status)','Crée une réponse HTTP JSON avec le code de statut indiqué.'],
['html(text,status)','Crée une réponse HTTP avec le type de contenu HTML.'],
['text(text,status)','Crée une réponse HTTP avec le type de contenu texte brut.'],
['redirect(url)','Crée une redirection HTTP vers url.']
]]
][$view];?>
<section class="layout"><aside class="side"><h4>Modules</h4><a href="/learn/sys">sys</a><a href="/learn/color">color</a><a href="/learn/math">math</a><a href="/learn/random">random</a><a href="/learn/fs">fs</a><a href="/learn/json">json</a><a href="/learn/webserver">webserver</a></aside><article class="doc"><h1><?=h($info[0])?></h1><p><?=h($info[1])?></p><h2>API</h2><?php foreach($info[2] as $x)echo '<div class="api"><b>'.h($x[0]).'</b><span>'.h($x[1]).'</span></div>'; if($view==='webserver'){?><h2>Méthodes de l’application</h2>
<?php foreach([
['app.get(path, handler)','Ajoute une route HTTP GET.'],
['app.post(path, handler)','Ajoute une route HTTP POST.'],
['app.put(path, handler)','Ajoute une route HTTP PUT.'],
['app.delete(path, handler)','Ajoute une route HTTP DELETE.'],
['app.patch(path, handler)','Ajoute une route HTTP PATCH.'],
['app.any(path, handler)','Ajoute une route acceptant toutes les méthodes HTTP.'],
['app.static(prefix, folder)','Expose un dossier local comme fichiers statiques sous le préfixe indiqué.'],
['app.start(port, host)','Démarre le serveur HTTP. Le port de l’application est utilisé par défaut et l’hôte 127.0.0.1 est utilisé par défaut.']
] as $x)echo '<div class="api"><b>'.h($x[0]).'</b><span>'.h($x[1]).'</span></div>';?><h2>Exemple complet</h2><?php code(<<<'CX'
use #int/webserver;

let app = webserver.create(8080);

app.get("/", fn(req) {
    return "<h1>Bonjour depuis Calyx</h1>";
});

app.get("/salut/:nom", fn(req) {
    return "Salut ${req.params.nom} !";
});

app.post("/api/echo", fn(req) {
    return webserver.json({
        recu: req.json,
        methode: req.method
    });
});

app.start();
CX);}elseif($view==='color'){?><h2>Exemple</h2><?php code('use #int/color;\nprint(color.green("Succès"));\nprint(color.bold(color.cyan("Calyx")));\nprint(color.rgb("Couleur personnalisée", 116, 224, 161));');}elseif($view==='sys'){?><h2>Exemple</h2><?php code('use #int/sys;\nprint(sys.os);\nprint(sys.arch);\nprint(sys.datetime());\nprint(sys.cwd);');}elseif($view==='fs'){?><h2>Exemple</h2><?php code('use #int/fs;\nfs.write("hello.txt", "Bonjour");\nprint(fs.read("hello.txt"));\nprint(fs.exists("hello.txt"));');}elseif($view==='json'){?><h2>Exemple</h2><?php code('use #int/json;\nlet data = { nom: "Calyx", version: 1 };\nlet raw = json.stringify(data, 2);\nprint(raw);\nprint(json.parse(raw));');}?></article></section>
<?php }else{?><section class="section"><div class="wrap"><h1>404</h1><p class="lead">Cette page Calyx n’existe pas.</p><a class="btn" href="/">Retour à l’accueil</a></div></section><?php }
$content=ob_get_clean(); ?><!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=h($title)?></title><link rel="icon" href="/assets/favicon.svg"><link rel="stylesheet" href="/assets/style.css"></head><body><?php layout($title,$view,$content); ?></body></html>
