import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import Sidebar from './components/Sidebar';
import Dashboard from './pages/Dashboard';
import MembersManager from './pages/MembersManager';
import EventManager from './pages/EventManager';
import LoginForm from './components/LoginForm';
import PrivateRoute from './components/PrivateRoute';
import './index.css';

function App() {
  const userString = localStorage.getItem('user');
  const user = userString ? JSON.parse(userString) : null;

  return (
    <Router>
      <div className="min-h-screen bg-gray-50 flex">
        <Sidebar />
        <main className="ml-20 flex-1">
          <div className="p-4">
            {!user && location.pathname !== '/login' && (
              <div className="flex justify-end">
                <a
                  href="/login"
                  className="px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800"
                >
                  Sign In
                </a>
              </div>
            )}
            <Routes>
              <Route path="/" element={<Dashboard />} />
              <Route
                path="/members"
                element={
                  <PrivateRoute allowedRoles={['admin', 'staff']}>
                    <MembersManager />
                  </PrivateRoute>
                }
              />
              <Route
                path="/events"
                element={
                  <PrivateRoute allowedRoles={['admin']}>
                    <EventManager />
                  </PrivateRoute>
                }
              />
              <Route path="/login" element={<LoginForm />} />
            </Routes>
          </div>
        </main>
      </div>
    </Router>
  );
}

export default App;
