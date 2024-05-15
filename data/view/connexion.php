<div class="content">
      <div class="juice">
        <div class="form-title">
          <h2 onclick="changeForm(this)" id="title-register">Inscription</h2>
          <h2 onclick="changeForm(this)" id="title-connexion">Connection</h2>
        </div>
        <form id="form-register" action="../controller/register.php" method="post">
            <div class="formLine">
                <label><img class="formAsset" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABQ0lEQVR4nO2UvUoDQRSFFwsttVQEN3OTWPgC+iTiQxhfIZ0/5+aHPJCWGqsEsbIwoHvvRouIRGIZmSWaQsxOdDQqe+A0MwMfZ+7MCYJMv1GFxtUCsewRpEmQp5GbeUjJ7n0LtFi9WSVom1iHH7hlz/hPionQN7jX5GSvNx2a2LDs+gSfu4IJcuYNbCB958SQvjcwuaYdeVaJH//+jPOQ0kxedSFpLG25/OON8uV84L25eCLcf3O9yqaxV2nnaB9cYtZTu+Y9aaafVXk4F1a7W8R6YFhOiCUm1ufEEDWQY4Lu5zjetGe/zFur3a8QpEaQrntlSkyQSoi75amBYb2zZKANgg6m7elxg+nAsNbpsLfoBDWVaJ1YOp8Gvq/Qazq6LaaCCXLhDTpO33YBq2+wgUbpYI52CPrgEdzLcbztNOdM/0ovVkGsmUf5Fe8AAAAASUVORK5CYII="></label>
                <input type="text" id="username" name="username" />
            </div>
            <div class="formLine">
                <label><img class="formAsset" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB+klEQVR4nO2Yzy5DQRTGSywlEmsJZ64FXoEEYcGK57CjEYlNLdtzauclxI7nsGHhz1J6TmND7Cxw5bRRvX9ao+b2FvMlJ2na3rnfb+Y7c6ctFLy8vLy8vOIqhcNTFVkEki1DvJdnAcmWelFPBRtNHN6NA8m5IQkHqYDkXL1ZQQQoa4bkYWDMIz8FyBtW5lsQh3fTgHyZt3lDcj1Z5ZkvDZtqbQVQyu1Zmzu6HzXIJ7mZRzk15YexlskwHNK+CCr15SQA1XebF/JZ2kUG+aV/xvmt22QCSTEBAMQHkWUry2wefQEpeY/HWb1+BdAcqMqbfe6L63jeDcl6fOKsAGyWsh95N8SviVWyBmhVhn2B35+kHgCy6QuwyLtLgJ5vaJv3wHJCegZw1hed8o52kfwZwE9MONoUwAnAN/vCZfzAIYCuxKPu1XFjBvmibeYv9L3E/o6Na8N8ARrFr1DhfY3Rx3iLpXBEV0NLX7dHTb+btr+b/AA69EVMrh6CkBlAE+IqoPpSfHw9QepnLu4BmQJ8gtwY5GMtILl1OTb0BSDDAg9AfgVCH6E/2MRS/DUAKDupf6vkbczYVrW2kgDQ84rrB04mhXITOVtFV4EXAOV5gKPzbJDnU81HIAZxJbBxNOluPhInrK0Cybb+gsq1SLY18x1j4+Xl5eX1r/UOP8h8VC4qJJwAAAAASUVORK5CYII="></label>
                <input type="email" id="mail" name="mail" />
            </div>
            <div class="formLine">
                <label><img class="formAsset" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABOklEQVR4nO2WsUoDQRCGt1exELRQwZlTFF9C7QxpfRJBbIWA5Ga08z0UES19A/UZkptZg5DC2Akqm2ysjOvdbYji/TDN3DDfzr+7d2dMpW+EbOeBpIGs90jyAiQdILkF0n1sdmfNOASse8DyjKzvXwbJY0K6Gx2KJG8OAKTnK6luLbCdcpGw3QbWi/4zlldkW49nLw8ntQej6+TQT9/dOM7mSoNhsKf9SYOLJL30kx+VBiPpg2vm7A3VJqnd8Yu8Kw0Gkp5rtnnWmQ7VrqdPMwOw9EqD0Z/acdVPHoxs60CajbyvOQNY28haC4J9YRToJ5y09WOrYoepwL/TapKrtdPW4mqzvQQk14XznBPsGgzzyUm2XDT/d8DOLtfMNQGWm6L56joFrf4fby6Y4EeiFhPuoNF/eyuZHPoAYYHe18MF56kAAAAASUVORK5CYII="></label>
                <input type="password" id="pwd" name="pwd" />
            </div>
            <input class="validate" type="submit" value="Valider" />
        </form>

        <form id="form-connexion" name="form-connexion" action="user.php" method="post">
          <div class="formLine">
            <label><img class='formAsset' src="../public/log.png";/></label>
            <input type="text" id="username" name="username" />
          </div>
          <div class="formLine">
            <label><img class='formAsset' src="../public/lock.png";/></label>
            <input type="password" id="pwd" name="pwd" />
          </div>
          <input class="validate" name="form-connexion" type="submit" value="Valider" />
        </form>
        <?php
          if (isset($error) && !empty($error)){
            echo $error;
          } 
        ?>
      </div>
    </div>