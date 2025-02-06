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
        <div className={`p-4 ${isExpanded ? '' : 'text-center'}`}>
          <div className="flex items-center justify-center mb-4">
            <img 
              src="https://assets.srcbook.com/logo.png" 
              alt="Logo" 
              className="h-10 w-auto"
            />
          </div>
          {isExpanded && (
            <>
              <h1 className="text-xl font-bold text-gray-800">Church Management</h1>
              {user ? (
                <p className="text-sm text-gray-600 mt-1">Welcome, {user.name}</p>
              ) : (
                <p className="text-sm text-gray-600 mt-1">Welcome, Guest</p>
              )}
            </>
          )}
        </div>

        <nav className="mt-8">
          {links.map((link) => {
            const Icon = link.icon;
            const isActive = location.pathname === link.to;
            
            return (
              <Link
                key={link.to}
                to={link.to}
                className={`flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 ${
                  isActive ? 'bg-gray-100' : ''
                } ${isExpanded ? '' : 'justify-center'}`}
                title={!isExpanded ? link.label : undefined}
              >
                <Icon className="w-5 h-5" />
                {isExpanded && <span className="ml-3">{link.label}</span>}
              </Link>
            );
          })}
          
          {user ? (
            <button
              onClick={handleLogoutClick}
              className={`w-full flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 ${
                isExpanded ? '' : 'justify-center'
              }`}
              title={!isExpanded ? 'Logout' : undefined}
            >
              <LogOut className="w-5 h-5" />
              {isExpanded && <span className="ml-3">Logout</span>}
            </button>
          ) : (
            <Link
              to="/login"
              className={`w-full flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 ${
                isExpanded ? '' : 'justify-center'
              }`}
              title={!isExpanded ? 'Login' : undefined}
            >
              <LogIn className="w-5 h-5" />
              {isExpanded && <span className="ml-3">Login</span>}
            </Link>
          )}
        </nav>
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
