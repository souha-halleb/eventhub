<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'EventHub'; ?></title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header class="header">
  <div class="header-content">
    <div class="header-left">
<div class="logo">📅 EventHub — Event Platform</div>
    </div>
  </div>
</header>
    <button class="scroll-to-top" id="scrollToTopBtn" title="Retour au haut">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>
    <script src="./js/main.js"></script>
</body>
</html>
