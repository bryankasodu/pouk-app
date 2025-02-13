import { LayoutDashboard, Users, Calendar, LogOut, LogIn } from 'lucide-react';
import { Link, useLocation, useNavigate } from 'react-router-dom';
import { useState } from 'react';

export default function Sidebar() {
  const location = useLocation();
  const navigate = useNavigate();
  const [isExpanded, setIsExpanded] = useState(false);
  const [showLogoutConfirm, setShowLogoutConfirm] = useState(false);
  const userString = localStorage.getItem('user');
  const user = userString ? JSON.parse(userString) : null;

  const handleLogoutClick = () => {
    setShowLogoutConfirm(true);
  };

  const handleLogoutConfirm = () => {
    localStorage.removeItem('user');
    setShowLogoutConfirm(false);
    navigate('/login');
  };

  // Base links that are always visible
  const publicLinks = [
    { to: '/', icon: LayoutDashboard, label: 'Dashboard' },
  ];

  // Additional links for authenticated users based on role
  const authenticatedLinks = user ? [
    ...(user.role === 'admin' || user.role === 'staff' ? [{ to: '/members', icon: Users, label: 'Members' }] : []),
    ...(user.role === 'admin' ? [{ to: '/events', icon: Calendar, label: 'Events' }] : []),
  ] : [];

  const links = [...publicLinks, ...authenticatedLinks];

  return (
    <>
      <div 
        className="fixed left-0 top-0 h-screen bg-white border-r border-gray-200 transition-all duration-300 hover:w-64 w-20 z-50"
        onMouseEnter={() => setIsExpanded(true)}
        onMouseLeave={() => setIsExpanded(false)}
      >
        <div className="h-full flex flex-col">
          {/* Logo section */}
          <div className="h-32 p-4 flex-shrink-0">
            <div className="relative">
              <div className="flex items-center justify-center">
                <img src="https://mocha-cdn.com/019487d8-fddd-78ae-9b91-195d53b350ce/logo_pouk.svg" alt="Logo" className="w-10 h-10" />
              </div>
              <div className={`mt-2 transition-opacity duration-300 ${isExpanded ? 'opacity-100' : 'opacity-0'}`}>
                <h1 className="text-xl font-bold text-gray-800 text-center truncate px-2">Church Management</h1>
                {user ? (
                  <p className="text-sm text-gray-600 mt-1 text-center truncate px-2">Welcome, {user.name}</p>
                ) : (
                  <p className="text-sm text-gray-600 mt-1 text-center truncate px-2">Welcome, Guest</p>
                )}
              </div>
            </div>
          </div>

          {/* Navigation Links */}
          <nav className="flex-1 overflow-y-auto overflow-x-hidden">
            {links.map((link) => {
              const Icon = link.icon;
              const isActive = location.pathname === link.to;
              
              return (
                <Link
                  key={link.to}
                  to={link.to}
                  className={`flex items-center h-12 px-4 text-gray-700 hover:bg-gray-100 ${
                    isActive ? 'bg-gray-100' : ''
                  }`}
                  title={!isExpanded ? link.label : undefined}
                >
                  <div className="w-12 flex-shrink-0 flex items-center justify-center">
                    <Icon className="w-5 h-5" />
                  </div>
                  <span className={`ml-2 transition-opacity duration-300 ${isExpanded ? 'opacity-100' : 'opacity-0'}`}>
                    {link.label}
                  </span>
                </Link>
              );
            })}
          </nav>
          
          {/* Auth Button */}
          <div className="flex-shrink-0">
            {user ? (
              <button
                onClick={handleLogoutClick}
                className="w-full flex items-center h-12 px-4 text-gray-700 hover:bg-gray-100"
                title={!isExpanded ? 'Logout' : undefined}
              >
                <div className="w-12 flex-shrink-0 flex items-center justify-center">
                  <LogOut className="w-5 h-5" />
                </div>
                <span className={`ml-2 transition-opacity duration-300 ${isExpanded ? 'opacity-100' : 'opacity-0'}`}>
                  Logout
                </span>
              </button>
            ) : (
              <Link
                to="/login"
                className="w-full flex items-center h-12 px-4 text-gray-700 hover:bg-gray-100"
                title={!isExpanded ? 'Login' : undefined}
              >
                <div className="w-12 flex-shrink-0 flex items-center justify-center">
                  <LogIn className="w-5 h-5" />
                </div>
                <span className={`ml-2 transition-opacity duration-300 ${isExpanded ? 'opacity-100' : 'opacity-0'}`}>
                  Login
                </span>
              </Link>
            )}
          </div>
        </div>
      </div>

      {/* Logout Confirmation Modal */}
      {showLogoutConfirm && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
          <div className="bg-white rounded-lg p-6 max-w-sm w-full mx-4">
            <h2 className="text-xl font-bold mb-4">Confirm Logout</h2>
            <p className="text-gray-600 mb-6">Are you sure you want to log out?</p>
            <div className="flex justify-end space-x-4">
              <button
                onClick={() => setShowLogoutConfirm(false)}
                className="px-4 py-2 text-gray-600 hover:text-gray-800"
              >
                Cancel
              </button>
              <button
                onClick={handleLogoutConfirm}
                className="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
              >
                Logout
              </button>
            </div>
          </div>
        </div>
      )}
    </>
  );
}
