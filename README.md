# Sistema de Pedidos de Pizzaria – PHP + MySQL

## Visão Geral

Projeto de estudo em PHP e MySQL para gerenciamento de pedidos de pizzaria.  
Permite criar pedidos, atualizar status e deletar pedidos, com interação direta com o banco.

---

## Tecnologias

- PHP 8.2
- MySQL
- HTML5 / CSS3 (responsivo)
- PDO com prepared statements
- Sessões PHP (`$_SESSION`)

---

## Funcionalidades

- Home (`index.php`): cria pedidos com seleção de borda, massa e até 3 sabores.
- Dashboard (`dashboard.php`): Lista pedidos com borda, massa, sabores e status.
- Atualização de status: (`em andamento`, `em entrega`, `finalizado`).
- Exclusão de pedidos.
- Responsividade: ajustes de layout, tabelas e botões para tablets e celulares.

---

## Estrutura do Projeto

/php-mysql-crud
├─ indexa.php # Home - formulário de pedidos
├─ dashboard.php # Dashboard de pedidos
├─ /templates
│ ├─ header.php
│ └─ footer.php
├─ /process
│ ├─ conn.php # Conexão com banco
│ ├─ pizza.php # Criação de pedidos
│ ├─ orders.php # Exclusão de pedidos
│ ├─ update_order_status.php # Atualização de status
│ └─ orders_fetch.php # Busca de pedidos e status
└─ /assets
└─ CSS, imagens, etc.

---

## Observações

- Cada ação no backend possui um arquivo específico.
- Responsivo para mobile e desktop.
- Ideal para estudo de CRUD, PDO, sessões e interação com banco em PHP.
