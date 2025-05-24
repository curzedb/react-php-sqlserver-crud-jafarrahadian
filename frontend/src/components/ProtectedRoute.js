import React, { useState, useEffect } from 'react';
import { Navigate } from 'react-router-dom';

const ProtectedRoute = ({ children }) => {
  const [isLoggedIn, setIsLoggedIn] = useState(null);

  useEffect(() => {
    const checkSession = async () => {
      try {
        const response = await fetch('/api/check_session.php');
        const data = await response.json();
        setIsLoggedIn(data.loggedin);
      } catch (error) {
        setIsLoggedIn(false);
      }
    };
    checkSession();
  }, []);

  if (isLoggedIn === null) {
    return <div>Loading...</div>; // Tampilkan loading saat sesi diperiksa
  }

  return isLoggedIn ? children : <Navigate to="/login" />;
};

export default ProtectedRoute;