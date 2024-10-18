<ul class="navbar-nav">
    <?php foreach ($categoryTree as $category): ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= htmlspecialchars($category['title']) ?>
            </a>
            <?php if (isset($category['children'])): ?>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php foreach ($category['children'] as $child): ?>
                        <a class="dropdown-item" href="#"><?= htmlspecialchars($child['title']) ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

