import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

const API_URL = '/api/users.php';

const Dashboard = () => {
  const [users, setUsers] = useState([]);
  const [currentUser, setCurrentUser] = useState({ ID: null, nama: '', email: '', jabatan: '' });
  const [isEditing, setIsEditing] = useState(false);
  const navigate = useNavigate();

  // Ambil data saat komponen dimuat
  useEffect(() => {
    fetchUsers();
  }, []);

  const fetchUsers = async () => {
    const response = await fetch(API_URL);
    const data = await response.json();
    if (data.message && data.message.includes("Akses ditolak")) {
        navigate('/login');
    } else {
        setUsers(data);
    }
  };

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setCurrentUser({ ...currentUser, [name]: value });
  };
  
  const handleLogout = async () => {
    await fetch('/api/logout.php');
    navigate('/login');
  };

  // Create & Update
  const handleSubmit = async (e) => {
    e.preventDefault();
    const url = isEditing ? `${API_URL}?id=${currentUser.ID}` : API_URL;
    const method = isEditing ? 'PUT' : 'POST';

    await fetch(url, {
      method: method,
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(currentUser),
    });
    
    resetForm();
    fetchUsers();
  };
  
  const handleEdit = (user) => {
    setIsEditing(true);
    setCurrentUser(user);
  };
  
  // Delete
  const handleDelete = async (id) => {
    if(window.confirm('Yakin ingin menghapus?')) {
      await fetch(`${API_URL}?id=${id}`, { method: 'DELETE' });
      fetchUsers();
    }
  };
  
  const resetForm = () => {
    setIsEditing(false);
    setCurrentUser({ ID: null, nama: '', email: '', jabatan: '' });
  };

  return (
    <div className="App">
       <header className="App-header">
        <h1>Dashboard Manajemen Pegawai</h1>
        <button onClick={handleLogout} className="logout-button">Logout</button>
      </header>
      <main className="container">
        <div className="form-container">
            <h2>{isEditing ? 'Edit Pegawai' : 'Tambah Pegawai Baru'}</h2>
            <form onSubmit={handleSubmit}>
                <input type="text" name="nama" placeholder="Nama" value={currentUser.nama} onChange={handleInputChange} required />
                <input type="email" name="email" placeholder="Email" value={currentUser.email} onChange={handleInputChange} required />
                <input type="text" name="jabatan" placeholder="Jabatan" value={currentUser.jabatan} onChange={handleInputChange} required />
                <button type="submit">{isEditing ? 'Update' : 'Tambah'}</button>
                {isEditing && <button type="button" className="cancel" onClick={resetForm}>Batal</button>}
            </form>
        </div>
        <h2>Daftar Pegawai</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {users.map(user => (
                    <tr key={user.ID}>
                        <td>{user.nama}</td>
                        <td>{user.email}</td>
                        <td>{user.jabatan}</td>
                        <td>
                            <button onClick={() => handleEdit(user)}>Edit</button>
                            <button className="delete" onClick={() => handleDelete(user.ID)}>Hapus</button>
                        </td>
                    </tr>
                ))}
            </tbody>
        </table>
      </main>
    </div>
  );
};

export default Dashboard;