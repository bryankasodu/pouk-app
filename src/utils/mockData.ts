import { Member, Event } from '../types/types';

export const mockMembers: Member[] = [
  {
    id: '1',
    firstName: 'John',
    lastName: 'Doe',
    email: 'john@example.com',
    phone: '123-456-7890',
    birthday: '1990-03-15',
    address: '123 Main St',
    region: 'A',
    familyGroup: 'Doe Family',
    isHeadOfFamily: true,
    healthStatus: 'healthy',
    notes: 'Regular attendee'
  },
  {
    id: '2',
    firstName: 'Jane',
    lastName: 'Smith',
    email: 'jane@example.com',
    phone: '123-456-7891',
    birthday: '1988-03-20',
    address: '456 Oak St',
    region: 'B',
    familyGroup: 'Smith Family',
    isHeadOfFamily: true,
    healthStatus: 'sick',
    notes: 'Needs prayer'
  },
];

export const mockEvents: Event[] = [
  {
    id: '1',
    name: 'Sunday Service',
    date: '2024-03-24',
    time: '10:00',
    location: 'Main Hall',
    category: 'worship',
    description: 'Weekly worship service'
  },
  {
    id: '2',
    name: 'Youth Meeting',
    date: '2024-03-25',
    time: '18:00',
    location: 'Youth Center',
    category: 'program',
    description: 'Weekly youth gathering'
  },
];
