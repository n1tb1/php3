<?php

final class DirectoryExplorer
{
    protected $path;
    protected $base;
    protected $current;

    public function __construct($path)
    {
        $this->path = $path;
        $this->base = dirname($path);
        $this->current = new DirectoryIterator($path);
    }

    public function getPath()
    {
        return $this->path == '/' ? '/' : $this->path . "/";
    }

    public function getBreadcrumbs()
    {
        return explode('/', $this->getPath());
    }

    public function getBase()
    {
        return $this->base;
    }

    public function getDirectory()
    {
        return $this->current;
    }
}

try {
    $path = (isset($_GET['path']) && !empty($_GET['path'])) ? $_GET['path'] : "/";
    $explorer = new DirectoryExplorer($path);
} catch (Exception $e) {
    echo get_class($e) . ": " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Path explorer</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css"
        integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
</head>
<body>
<table class='table table-condensed' style='width: 700px; margin: 50px auto;'>
  <tr>
    <td colspan="2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php foreach ($explorer->getBreadcrumbs() as $item) : ?>
              <li class="breadcrumb-item"><a href="#"><?= $item; ?></a></li>
            <?php endforeach; ?>
        </ol>
      </nav>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <a href='explorer.php?path=<?= $explorer->getBase(); ?>' style='width: 700px; margin: 50px auto;'>
        <button class='btn btn-primary'>back</button>
      </a>
    </td>
  </tr>
    <?php foreach ($explorer->getDirectory() as $item) : ?>
    <?php if($item == "." || $item == "..") : ?>
        <?php continue; ?>
    <?php endif; ?>
    <?php if(is_dir($explorer->getPath() . $item)) : ?>
        <tr>
          <td><i class='fa fa-folder' style="color:orange"></i></td>
          <td>
            <a href='explorer.php?path=<?= $explorer->getPath() . $item; ?>'><?= $item; ?></a>
          </td>
        </tr>
    <?php else : ?>
        <tr>
          <td><i class='fa fa-file' style="color:gray"></i></td>
          <td>
              <?= $item; ?>
          </td>
        </tr>
    <?php endif; ?>
    <?php endforeach; ?>
</table>
</body>
</html>
