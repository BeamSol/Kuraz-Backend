<!-- <!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
<h1>Task Dashboard</h1>

<button onclick="logout()">Logout</button>

<h2>Create Task</h2>
<form id="taskForm">
    <input name="title" placeholder="Title" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <select name="status">
        <option value="pending">Pending</option>
        <option value="in_progress">In Progress</option>
        <option value="completed">Completed</option>
    </select><br>
    <select name="priority">
        <option value="low">Low</option>
        <option value="medium" selected>Medium</option>
        <option value="high">High</option>
    </select><br>
    <input type="date" name="deadline" required><br>
    <button type="submit">Add Task</button>
</form>

<h2>Your Tasks</h2>
<div id="tasks"></div>

<script>
const token = localStorage.getItem('token');
if (!token) window.location.href = '/';

function logout() {
    fetch('/api/logout', {
        method: 'POST',
        headers: { Authorization: `Bearer ${token}` }
    }).then(() => {
        localStorage.removeItem('token');
        window.location.href = '/';
    });
}

async function fetchTasks() {
    const res = await fetch('/api/tasks', {
        headers: { Authorization: `Bearer ${token}` }
    });
    const tasks = await res.json();
    const taskContainer = document.getElementById('tasks');
    taskContainer.innerHTML = tasks.map(task => `
        <div style="border:1px solid #000; margin:10px; padding:10px;">
            <strong>${task.title}</strong> (${task.status})<br>
            Priority: ${task.priority}<br>
            Deadline: ${task.deadline}<br>
            <button onclick="deleteTask(${task.id})">Delete</button>
        </div>
    `).join('');
}

async function deleteTask(id) {
    await fetch(`/api/tasks/${id}`, {
        method: 'DELETE',
        headers: { Authorization: `Bearer ${token}` }
    });
    fetchTasks();
}

document.getElementById('taskForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    const form = e.target;
    const body = {
        title: form.title.value,
        description: form.description.value,
        status: form.status.value,
        priority: form.priority.value,
        deadline: form.deadline.value
    };
    await fetch('/api/tasks', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${token}`
        },
        body: JSON.stringify(body)
    });
    form.reset();
    fetchTasks();
});

fetchTasks();
</script>
</body>
</html> -->

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
</head>
<body>
  <h1>Task Dashboard</h1>

  <button onclick="logout()">Logout</button>

  <h2 id="formTitle">Create Task</h2>
  <form id="taskForm">
    <input type="hidden" name="task_id">
    <input name="title" placeholder="Title" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <select name="status">
      <option value="pending">Pending</option>
      <option value="in_progress">In Progress</option>
      <option value="completed">Completed</option>
    </select><br>
    <select name="priority">
      <option value="low">Low</option>
      <option value="medium" selected>Medium</option>
      <option value="high">High</option>
    </select><br>
    <input type="date" name="deadline" required><br>
    <button type="submit">Save Task</button>
    <button type="button" onclick="cancelEdit()" id="cancelEditBtn" style="display:none;">Cancel Edit</button>
  </form>

  <h2>Your Tasks</h2>
  <div id="tasks"></div>

  <script>
    const token = localStorage.getItem('token');
    if (!token) window.location.href = '/';

    function logout() {
      fetch('/api/logout', {
        method: 'POST',
        headers: { Authorization: `Bearer ${token}` }
      }).then(() => {
        localStorage.removeItem('token');
        window.location.href = '/';
      });
    }

    async function fetchTasks() {
      const res = await fetch('/api/tasks', {
        headers: { Authorization: `Bearer ${token}` }
      });
      const tasks = await res.json();
      const taskContainer = document.getElementById('tasks');
      taskContainer.innerHTML = tasks.map(task => `
        <div style="border:1px solid #000; margin:10px; padding:10px;">
          <strong>${task.title}</strong> (${task.status})<br>
          Priority: ${task.priority}<br>
          Deadline: ${task.deadline}<br>
          <button onclick='editTask(${JSON.stringify(task).replace(/'/g, "&apos;")})'>Edit</button>
          <button onclick="deleteTask(${task.id})">Delete</button>
        </div>
      `).join('');
    }

    function editTask(task) {
      const form = document.getElementById('taskForm');
      form.task_id.value = task.id;
      form.title.value = task.title;
      form.description.value = task.description || '';
      form.status.value = task.status;
      form.priority.value = task.priority;
      form.deadline.value = task.deadline;

      document.getElementById('formTitle').textContent = 'Edit Task';
      document.getElementById('cancelEditBtn').style.display = 'inline';
    }

    function cancelEdit() {
      const form = document.getElementById('taskForm');
      form.reset();
      form.task_id.value = '';
      document.getElementById('formTitle').textContent = 'Create Task';
      document.getElementById('cancelEditBtn').style.display = 'none';
    }

    async function deleteTask(id) {
      await fetch(`/api/tasks/${id}`, {
        method: 'DELETE',
        headers: { Authorization: `Bearer ${token}` }
      });
      fetchTasks();
    }

    document.getElementById('taskForm').addEventListener('submit', async function (e) {
      e.preventDefault();
      const form = e.target;
      const taskId = form.task_id.value;

      const body = {
        title: form.title.value,
        description: form.description.value,
        status: form.status.value,
        priority: form.priority.value,
        deadline: form.deadline.value
      };

      const url = taskId ? `/api/tasks/${taskId}` : '/api/tasks';
      const method = taskId ? 'PUT' : 'POST';

      await fetch(url, {
        method,
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`
        },
        body: JSON.stringify(body)
      });

      form.reset();
      form.task_id.value = '';
      document.getElementById('formTitle').textContent = 'Create Task';
      document.getElementById('cancelEditBtn').style.display = 'none';
      fetchTasks();
    });

    fetchTasks();
  </script>
</body>
</html>

    