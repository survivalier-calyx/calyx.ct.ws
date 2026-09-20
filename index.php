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
'/learn/json'=>['Module json','json'],
'/learn/webserver'=>['Module webserver','webserver'],
'/learn/modules'=>['Système de modules','modules'],
'/learn/technical'=>['Architecture technique','technical'],
'/docs'=>['Documentation technique','docs'],
];
if(isset($_GET['source'])){ $f=__DIR__.'/download/files/'.basename($_GET['source']); if(is_file($f)){header('Content-Type:text/plain; charset=utf-8');readfile($f);exit;}}
if(!isset($pages[$path])){http_response_code(404);$title='404';$view='404';}else[$title,$view]=$pages[$path];
function h($s){return htmlspecialchars($s,ENT_QUOTES,'UTF-8');}
function nav($active){$items=['/'=>'Accueil','/install'=>'Installer','/learn'=>'Apprendre','/docs'=>'Documentation'];echo '<nav class="nav"><div class="navin"><a class="brand" href="/"><img src="/assets/logo.svg">Calyx</a><div class="links">';foreach($items as $u=>$n)echo '<a class="'.($active==$u?'active':'').'" href="'.$u.'">'.$n.'</a>';echo '</div><div class="spacer"></div><a class="github" href="https://github.com/">GitHub</a><a class="download" href="/install">Installer</a></div></nav>';}
function layout($title,$view,$content){nav($view=='home'?'/':($view=='install'?'/install':($view=='learn'?'/learn':'/docs')));echo '<main>'.$content.'</main><footer class="footer"><div class="wrap">Calyx 1.0.3 · langage simple et modulaire · Python 3.8+ · Linux · macOS · Windows</div></footer>';}
function code($s){echo '<pre class="code">'.h(trim($s)).'</pre>';}
ob_start();
if($view==='home'){?>
<section class="hero"><div class="wrap hero-grid"><div><span class="eyebrow"><i class="dot"></i> Calyx 1.0.3</span><h1>Un langage.<br>Simple. Modulaire.</h1><p>Calyx est un langage de programmation lisible et léger, conçu pour écrire rapidement des scripts, des outils et de petits serveurs web.</p><div class="actions"><a class="btn primary" href="/install">Télécharger Calyx</a><a class="btn" href="/learn">Commencer à apprendre →</a></div></div><div class="terminal"><div class="termbar"><i></i><i></i><i></i></div><span class="muted">$</span> calyx hello.cx<br><br><span class="green">Bonjour depuis Calyx !</span><br><span class="muted">runtime:</span> Calyx 1.0.3<br><span class="muted">platform:</span> Linux<br><br><span class="blue">ready.</span></div></div></section>
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
<section class="section"><div class="wrap"><h1> Télécharger Calyx</h1><p class="lead">Calyx 1.0.3 est distribué comme un runtime Python sans dépendance externe.</p><div class="cards"><div class="card"><div class="icon">↓</div><h3>Archive complète</h3><p>Runtime, installateur, licence et exemples.</p><br><a class="btn primary" href="/download/calyx-1.0.3.zip">Télécharger .zip</a></div><div class="card"><div class="icon">Py</div><h3>Runtime</h3><p>Le fichier principal est <code>calyx.py</code>. Python 3.8 ou plus récent est requis.</p><br><a class="btn" href="/download/files/calyx.py">Voir le code</a></div><div class="card"><div class="icon">✓</div><h3>Installation</h3><p>Un installateur graphique et une version CLI sont inclus.</p><br><a class="btn" href="/download/files/installer.py">Installer.py</a></div></div>
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
