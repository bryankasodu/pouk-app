export interface Member {
  id: string;
  firstName: string;
  lastName: string;
  email: string;
  phone: string;
  birthday: string;
  address: string;
  region: 'A' | 'B' | 'C';
  familyGroup: string;
  isHeadOfFamily: boolean;
  healthStatus: 'healthy' | 'sick';
  notes?: string;
}

export interface Event {
  id: string;
  name: string;
  date: string;
  time: string;
  location: string;
  category: 'worship' | 'program' | 'community';
  description?: string;
}

export interface User {
  id: string;
  email: string;
  role: 'admin' | 'staff' | 'viewer';
  name: string;
}

export interface AuthState {
  user: User | null;
  isAuthenticated: boolean;
}
