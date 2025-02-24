<?php
include('db.php');


if (isset($_POST['criar'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $sql = "INSERT INTO tarefas (nome, descricao) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao]);
    header('Location: index.php');
}


if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $sql = "SELECT * FROM tarefas WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $tarefa = $stmt->fetch();
}

if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $sql = "UPDATE tarefas SET nome = ?, descricao = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $id]);
    header('Location: index.php');
}

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $sql = "DELETE FROM tarefas WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    header('Location: index.php');
}


$sql = "SELECT * FROM tarefas";
$stmt = $pdo->query($sql);
$tarefas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Tarefas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1, h2 {
            color: #444;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            width: 300px;
            text-align: center;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #fff;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <h1>Lista de Tarefas</h1>


    <form method="post">
        <input type="hidden" name="id" value="<?php echo isset($tarefa) ? $tarefa['id'] : ''; ?>">
        <label for="nome">Nome da Tarefa:</label>
        <input type="text" name="nome" value="<?php echo isset($tarefa) ? $tarefa['nome'] : ''; ?>" required>
        <br>
        <label for="descricao">Descrição da Tarefa:</label>
        <textarea name="descricao" required><?php echo isset($tarefa) ? $tarefa['descricao'] : ''; ?></textarea>
        <br>
        <?php if (isset($tarefa)) { ?>
            <button type="submit" name="atualizar">Atualizar Tarefa</button>
        <?php } else { ?>
            <button type="submit" name="criar">Criar Tarefa</button>
        <?php } ?>
    </form>

    <h2>Lista de Tarefas:</h2>
    <ul>
        <?php foreach ($tarefas as $tarefa) { ?>
            <li>
                <?php echo htmlspecialchars($tarefa['nome']) . ' - ' . htmlspecialchars($tarefa['descricao']); ?>
                <a href="index.php?editar=<?php echo $tarefa['id']; ?>">Editar</a> |
                <a href="index.php?excluir=<?php echo $tarefa['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </li>
        <?php } ?>
    </ul>
</body>
</html>




