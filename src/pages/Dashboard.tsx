import { useState, useEffect } from 'react';
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
  ArcElement,
} from 'chart.js';
import { Bar, Pie } from 'react-chartjs-2';
import { mockMembers, mockEvents } from '../utils/mockData';
import { format } from 'date-fns';
import { Calendar } from 'lucide-react';

ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
  ArcElement
);

export default function Dashboard() {
  const userString = localStorage.getItem('user');
  const user = userString ? JSON.parse(userString) : null;

  const [healthData, setHealthData] = useState({
    labels: ['Healthy', 'Sick'],
    datasets: [{
      data: [0, 0],
      backgroundColor: ['#4ade80', '#f87171'],
    }],
  });

  const nextEvent = mockEvents.length > 0 ? mockEvents[0] : null;

  useEffect(() => {
    const healthStatus = mockMembers.reduce((acc, member) => {
      acc[member.healthStatus] = (acc[member.healthStatus] || 0) + 1;
      return acc;
    }, {} as Record<string, number>);

    setHealthData({
      labels: ['Healthy', 'Sick'],
      datasets: [{
        data: [healthStatus['healthy'] || 0, healthStatus['sick'] || 0],
        backgroundColor: ['#4ade80', '#f87171'],
      }],
    });
  }, []);

  // Public view shows only upcoming events
  if (!user) {
    return (
      <div className="p-6 space-y-6 max-w-7xl mx-auto">
        <div className="text-center mb-8">
          <h1 className="text-3xl font-bold text-gray-800">Welcome to Church Management</h1>
          <p className="text-gray-600 mt-2">Sign in to access all features</p>
        </div>

        {nextEvent && (
          <div className="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-xl p-8 mb-8">
            <div className="flex items-start justify-between">
              <div>
                <h2 className="text-2xl font-bold mb-2">Next Upcoming Event</h2>
                <h3 className="text-3xl font-bold mb-4">{nextEvent.name}</h3>
                <div className="flex items-center space-x-4">
                  <Calendar className="w-5 h-5" />
                  <p className="text-lg">
                    {format(new Date(nextEvent.date), 'MMMM d, yyyy')} at {nextEvent.time}
                  </p>
                </div>
                <p className="mt-2 text-lg">Location: {nextEvent.location}</p>
              </div>
              <span className="px-4 py-2 bg-white text-blue-800 rounded-full text-sm font-semibold">
                {nextEvent.category}
              </span>
            </div>
          </div>
        )}

        {/* Public Events */}
        <div className="bg-white p-6 rounded-lg shadow-sm">
          <h3 className="text-lg font-semibold mb-4">All Upcoming Events</h3>
          <div className="space-y-4">
            {mockEvents.map(event => (
              <div
                key={event.id}
                className={`p-4 rounded-lg ${
                  event.category === 'worship'
                    ? 'bg-blue-50'
                    : event.category === 'program'
                    ? 'bg-green-50'
                    : 'bg-yellow-50'
                }`}
              >
                <div className="flex justify-between items-start">
                  <div>
                    <h4 className="font-semibold">{event.name}</h4>
                    <p className="text-sm text-gray-600">
                      {format(new Date(event.date), 'MMM d, yyyy')} at {event.time}
                    </p>
                    <p className="text-sm text-gray-600">{event.location}</p>
                  </div>
                  <span
                    className={`text-xs px-2 py-1 rounded-full ${
                      event.category === 'worship'
                        ? 'bg-blue-100 text-blue-800'
                        : event.category === 'program'
                        ? 'bg-green-100 text-green-800'
                        : 'bg-yellow-100 text-yellow-800'
                    }`}
                  >
                    {event.category}
                  </span>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    );
  }

  // Authenticated view shows full dashboard
  const sickMembers = mockMembers.filter(m => m.healthStatus === 'sick');
  const birthdaysThisWeek = mockMembers.filter(member => {
    const birthday = new Date(member.birthday);
    const today = new Date();
    const nextWeek = new Date();
    nextWeek.setDate(today.getDate() + 7);
    
    const thisYearBirthday = new Date(
      today.getFullYear(),
      birthday.getMonth(),
      birthday.getDate()
    );
    
    return thisYearBirthday >= today && thisYearBirthday <= nextWeek;
  });

  return (
    <div className="p-6 space-y-6">
      <h1 className="text-2xl font-bold text-gray-800">Dashboard</h1>
      
      {nextEvent && (
        <div className="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-xl p-8 mb-8">
          <div className="flex items-start justify-between">
            <div>
              <h2 className="text-2xl font-bold mb-2">Next Upcoming Event</h2>
              <h3 className="text-3xl font-bold mb-4">{nextEvent.name}</h3>
              <div className="flex items-center space-x-4">
                <Calendar className="w-5 h-5" />
                <p className="text-lg">
                  {format(new Date(nextEvent.date), 'MMMM d, yyyy')} at {nextEvent.time}
                </p>
              </div>
              <p className="mt-2 text-lg">Location: {nextEvent.location}</p>
            </div>
            <span className="px-4 py-2 bg-white text-blue-800 rounded-full text-sm font-semibold">
              {nextEvent.category}
            </span>
          </div>
        </div>
      )}
      
      {/* Main Stats */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div className="bg-white p-6 rounded-lg shadow-sm">
          <h3 className="text-lg font-semibold mb-2">Total Members</h3>
          <p className="text-3xl font-bold text-blue-600">{mockMembers.length}</p>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm">
          <h3 className="text-lg font-semibold mb-2">Sick Members</h3>
          <p className="text-3xl font-bold text-red-600">{sickMembers.length}</p>
        </div>
        
        <div className="bg-white p-6 rounded-lg shadow-sm">
          <h3 className="text-lg font-semibold mb-2">Total Families</h3>
          <p className="text-3xl font-bold text-green-600">
            {new Set(mockMembers.map(m => m.familyGroup)).size}
          </p>
        </div>
      </div>

      {/* Events and Charts */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Weekly Schedule */}
        <div className="bg-white p-6 rounded-lg shadow-sm">
          <h3 className="text-lg font-semibold mb-4">All Upcoming Events</h3>
          <div className="space-y-4">
            {mockEvents.map(event => (
              <div
                key={event.id}
                className={`p-4 rounded-lg ${
                  event.category === 'worship'
                    ? 'bg-blue-50'
                    : event.category === 'program'
                    ? 'bg-green-50'
                    : 'bg-yellow-50'
                }`}
              >
                <div className="flex justify-between items-start">
                  <div>
                    <h4 className="font-semibold">{event.name}</h4>
                    <p className="text-sm text-gray-600">
                      {format(new Date(event.date), 'MMM d, yyyy')} at {event.time}
                    </p>
                    <p className="text-sm text-gray-600">{event.location}</p>
                  </div>
                  <span
                    className={`text-xs px-2 py-1 rounded-full ${
                      event.category === 'worship'
                        ? 'bg-blue-100 text-blue-800'
                        : event.category === 'program'
                        ? 'bg-green-100 text-green-800'
                        : 'bg-yellow-100 text-yellow-800'
                    }`}
                  >
                    {event.category}
                  </span>
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Health Status Distribution */}
        <div className="bg-white p-6 rounded-lg shadow-sm">
          <h3 className="text-lg font-semibold mb-4">Member Health Status</h3>
          <div className="h-64">
            <Pie 
              data={healthData} 
              options={{ 
                maintainAspectRatio: false,
                plugins: {
                  legend: {
                    position: 'bottom',
                  },
                },
              }} 
            />
          </div>
        </div>
      </div>

      {/* Birthdays */}
      <div className="bg-white p-6 rounded-lg shadow-sm">
        <h3 className="text-lg font-semibold mb-4">Upcoming Birthdays</h3>
        {birthdaysThisWeek.length > 0 ? (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            {birthdaysThisWeek.map(member => (
              <div key={member.id} className="p-4 bg-pink-50 rounded-lg">
                <p className="font-semibold">
                  {member.firstName} {member.lastName}
                </p>
                <p className="text-sm text-gray-600">
                  {format(new Date(member.birthday), 'MMM d, yyyy')}
                </p>
                <p className="text-sm text-gray-600">
                  Health Status: 
                  <span className={member.healthStatus === 'sick' ? 'text-red-600' : 'text-green-600'}>
                    {' '}{member.healthStatus}
                  </span>
                </p>
              </div>
            ))}
          </div>
        ) : (
          <p className="text-gray-500">No birthdays this week</p>
        )}
      </div>
    </div>
  );
}
