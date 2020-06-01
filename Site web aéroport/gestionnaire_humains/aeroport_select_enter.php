<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Entrée des informations</title>
  </head>
  <body>
    <div align="right">
      <table width="30%">
        <tr>
          <td align="right">
            <form action="aeroport_select_infos.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="35%">
            </form>
          </td>
        </tr>
      </table>
    </div>

    <form id = "select" action="aeroport_select_show.php" method="post">
      <div align="center">
        <h3>Entrez les informations nécessaires</h3>
        <table width="30%" class="tableau">
        <?php
        $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
        if ($link->connect_errno) {
        die ("Erreur de connexion : errno: " . $link->errno .
                          "error:" . $link->error);
        }

        $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

        if($_POST['choix']=="employe")
        {
          if($_POST['employe']=="numero")
          {
        ?>
            <tr>
              <td align = center>
                <br>
                Numéro d'employé : <br><br>
                <select form = "select" name="num_employe" required>
                  <?php

                  $res = $link->query("SELECT num_employe FROM Employe GROUP BY num_employe ORDER BY num_employe")
                  or die("Search Error:" .$link->error());

                  $iterator = $res->fetch_assoc();

                  while($iterator)
                  {
                    ?>
                    <option value = "<?php echo $iterator['num_employe']?>">
                    <?php
                    echo '<p>' . $iterator['num_employe'] . '</p>';
                    ?>
                    </option>
                    <?php
                    $iterator = $res->fetch_assoc();
                  }
                  $res->free();
                  ?>"
                  >
                </select>
                <br><br>
              </td>
            </tr>
        <?php
          }
          else if($_POST['employe']=="equipage")
          {
        ?>
            <tr>
              <td align = center>
                Numéro d'équipage: <br><br>
                <select form = "select" name="equipage" required>
                  <?php

                  $res = $link->query("SELECT num_equipage FROM Employe GROUP BY num_equipage ORDER BY num_equipage")
                  or die("Search Error:" .$link->error());

                  $iterator = $res->fetch_assoc();

                  while($iterator)
                  {
                    ?>
                    <option value = "<?php echo $iterator['num_equipage']?>">
                    <?php
                    echo '<p>' . $iterator['num_equipage'] . '</p>';
                    ?>
                    </option>
                    <?php
                    $iterator = $res->fetch_assoc();
                  }
                  $res->free();
                  ?>"
                  >
                </select>
                <br><br>
              </td>
            </tr>
        <?php
          }
          else if($_POST['employe']=="role")
          {
        ?>
            <tr>
              <td align = center>
                Rôle : <br><br>
                <select form = "select" name="role" required>
                  <?php

                  $res = $link->query("SELECT role FROM Employe GROUP BY role ORDER BY role")
                  or die("Search Error:" .$link->error());

                  $iterator = $res->fetch_assoc();

                  while($iterator)
                  {
                    ?>
                    <option value = "<?php echo $iterator['role']?>">
                    <?php
                    echo '<p>' . $iterator['role'] . '</p>';
                    ?>
                    </option>
                    <?php
                    $iterator = $res->fetch_assoc();
                  }
                  $res->free();
                  ?>"
                  >
                </select>
              </td>
            </tr>
        <?php
          }
          else if($_POST['employe']=="nationalite")
          {
            ?>
                <tr>
                  <td align = center>
                    Nationalité : <br><br>
                    <select form = "select" name="nationalite" required>
                      <?php

                      $res = $link->query("SELECT nationalite_employe FROM Employe GROUP BY nationalite_employe ORDER BY nationalite_employe")
                      or die("Search Error:" .$link->error());

                      $iterator = $res->fetch_assoc();

                      while($iterator)
                      {
                        ?>
                        <option value = "<?php echo $iterator['nationalite_employe']?>">
                        <?php
                        echo '<p>' . $iterator['nationalite_employe'] . '</p>';
                        ?>
                        </option>
                        <?php
                        $iterator = $res->fetch_assoc();
                      }
                      $res->free();
                      ?>"
                      >
                    </select>
                  </td>
                </tr>
            <?php
          }
          else {
            ?>
                <tr>
                  <td align = center>
                    Sexe : <br><br>
                    <select form = "select" name="sexe" required>
                      <?php

                      $res = $link->query("SELECT sexe_employe FROM Employe GROUP BY sexe_employe ORDER BY sexe_employe")
                      or die("Search Error:" .$link->error());

                      $iterator = $res->fetch_assoc();

                      while($iterator)
                      {
                        ?>
                        <option value = "<?php echo $iterator['sexe_employe']?>">
                        <?php
                        echo '<p>' . $iterator['sexe_employe'] . '</p>';
                        ?>
                        </option>
                        <?php
                        $iterator = $res->fetch_assoc();
                      }
                      $res->free();
                      ?>"
                      >
                    </select>
                  </td>
                </tr>
            <?php
          }
            ?>
          <tr>
            <td align = "center">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="hidden" name="employe" value="<?php echo $_POST['employe'] ?>">
              <input type="image" src = "../images/button_submit.png" width="30%">
            </td>
          </tr>
        <?php
        }
        else if($_POST['choix']=="passager")
        {

          if($_POST['passager']=="numero")
          {
          ?>
              <tr>
                <td align = center>
                  <br>Numéro de passager : <br><br>
                  <select form = "select" name="num_passager" required>
                    <?php

                    $res = $link->query("SELECT id_passager FROM Passager GROUP BY id_passager ORDER BY id_passager")
                    or die("Search Error:" .$link->error());

                    $iterator = $res->fetch_assoc();

                    while($iterator)
                    {
                      ?>
                      <option value = "<?php echo $iterator['id_passager']?>">
                      <?php
                      echo '<p>' . $iterator['id_passager'] . '</p>';
                      ?>
                      </option>
                      <?php
                      $iterator = $res->fetch_assoc();
                    }
                    $res->free();
                    ?>"
                    >
                  </select>
                </td>
              </tr>
          <?php
            }
            else if($_POST['passager']=="passeport")
            {
          ?>
              <tr>
                <td align = center>
                  <br>Numéro de passeport : <br><br>
                  <select form = "select" name="passeport" required>
                    <?php

                    $res = $link->query("SELECT num_passeport FROM Passager GROUP BY num_passeport ORDER BY num_passeport")
                    or die("Search Error:" .$link->error());

                    $iterator = $res->fetch_assoc();

                    while($iterator)
                    {
                      ?>
                      <option value = "<?php echo $iterator['num_passeport']?>">
                      <?php
                      echo '<p>' . $iterator['num_passeport'] . '</p>';
                      ?>
                      </option>
                      <?php
                      $iterator = $res->fetch_assoc();
                    }
                    $res->free();
                    ?>"
                    >
                  </select>
                </td>
              </tr>
          <?php
            }
            else if($_POST['passager']=="nationalite")
            {
              ?>
                  <tr>
                    <td align = center>
                      Nationalité : <br><br>
                      <select form = "select" name="nationalite" required>
                        <?php

                        $res = $link->query("SELECT nationalite_passager FROM Passager GROUP BY nationalite_passager ORDER BY nationalite_passager")
                        or die("Search Error:" .$link->error());

                        $iterator = $res->fetch_assoc();

                        while($iterator)
                        {
                          ?>
                          <option value = "<?php echo $iterator['nationalite_passager']?>">
                          <?php
                          echo '<p>' . $iterator['nationalite_passager'] . '</p>';
                          ?>
                          </option>
                          <?php
                          $iterator = $res->fetch_assoc();
                        }
                        $res->free();
                        ?>"
                        >
                      </select>
                    </td>
                  </tr>
              <?php
            }
            else {
              ?>
                  <tr>
                    <td align = center>
                      Sexe : <br><br>
                      <select form = "select" name="sexe" required>
                        <?php

                        $res = $link->query("SELECT sexe_passager FROM Passager GROUP BY sexe_passager ORDER BY sexe_passager")
                        or die("Search Error:" .$link->error());

                        $iterator = $res->fetch_assoc();

                        while($iterator)
                        {
                          ?>
                          <option value = "<?php echo $iterator['sexe_passager']?>">
                          <?php
                          echo '<p>' . $iterator['sexe_passager'] . '</p>';
                          ?>
                          </option>
                          <?php
                          $iterator = $res->fetch_assoc();
                        }
                        $res->free();
                        ?>"
                        >
                      </select>
                    </td>
                  </tr>
              <?php
            }
              ?>
            <tr>
              <td align = "center">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                <input type="hidden" name="passager" value="<?php echo $_POST['passager'] ?>">
                <input type="image" src = "../images/button_submit.png" width="30%">
              </td>
            </tr>
          <?php
        }
        else if($_POST['choix']=="travaille")
        {
          if($_POST['travaille']=="employe")
          {
          ?>
              <tr>
                <td align = center>
                  <br>
                  Numéro d'employé : <br><br>
                  <select form = "select" name="employe" required>
                    <?php

                    $res = $link->query("SELECT num_employe FROM Travaille GROUP BY num_employe ORDER BY num_employe")
                    or die("Search Error:" .$link->error());

                    $iterator = $res->fetch_assoc();

                    while($iterator)
                    {
                      ?>
                      <option value = "<?php echo $iterator['num_employe']?>">
                      <?php
                      echo '<p>' . $iterator['num_employe'] . '</p>';
                      ?>
                      </option>
                      <?php
                      $iterator = $res->fetch_assoc();
                    }
                    $res->free();
                    ?>"
                    >
                  </select>
                  <br><br>
                </td>
              </tr>
          <?php
            }
            else
            {
          ?>
              <tr>
                <td align = center>
                  <br>
                  Numéro de vol : <br><br>
                  <select form = "select" name="vol" required>
                    <?php

                    $res = $link->query("SELECT num_vol FROM Travaille GROUP BY num_vol ORDER BY num_vol")
                    or die("Search Error:" .$link->error());

                    $iterator = $res->fetch_assoc();

                    while($iterator)
                    {
                      ?>
                      <option value = "<?php echo $iterator['num_vol']?>">
                      <?php
                      echo '<p>' . $iterator['num_vol'] . '</p>';
                      ?>
                      </option>
                      <?php
                      $iterator = $res->fetch_assoc();
                    }
                    $res->free();
                    ?>"
                    >
                  </select>
                  <br><br>
                </td>
              </tr>
          <?php
            }
          ?>
            <tr>
              <td align = "center">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                <input type="hidden" name="travaille" value="<?php echo $_POST['travaille'] ?>">
                <input type="image" src = "../images/button_submit.png" width="30%">
              </td>
            </tr>
          <?php
        }
        else
        {
          if($_POST['bagage']=="bagage")
          {
          ?>
              <tr>
                <td align = center>
                  <br>Numéro de bagage: <input type="number" name="num_bagage" min ="1" required><br><br>
                </td>
              </tr>
          <?php
            }
            else
            {
          ?>
              <tr>
                <td align = center>
                  <br>Numéro du billet : <input type="number" name="billet" min ="1" required><br><br>
                </td>
              </tr>
          <?php
            }
          ?>
            <tr>
              <td align = "center">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                <input type="hidden" name="bagage" value="<?php echo $_POST['bagage'] ?>">
                <input type="image" src = "../images/button_submit.png" width="30%">
              </td>
            </tr>
          <?php
        }
        $link->close();
        ?>
        </table>
      </div>
    </form>
  </body>
</html>
