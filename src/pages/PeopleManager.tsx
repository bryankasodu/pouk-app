import { useMemo } from 'react';
import DataTable from '../components/DataTable';
import { mockPeople } from '../utils/mockData';
import { format } from 'date-fns';

export default function PeopleManager() {
  const columns = useMemo(
    () => [
      {
        header: 'Name',
        accessorFn: (row: any) => `${row.firstName} ${row.lastName}`,
      },
      {
        header: 'Email',
        accessorKey: 'email',
      },
      {
        header: 'Birthday',
        accessorKey: 'birthday',
        cell: (info: any) => format(new Date(info.getValue()), 'MMM d, yyyy'),
      },
      {
        header: 'Department',
        accessorKey: 'department',
      },
      {
        header: 'Notes',
        accessorKey: 'notes',
      },
    ],
    []
  );

  return (
    <div className="p-6">
      <h1 className="text-2xl font-bold text-gray-800 mb-6">People Manager</h1>
      <DataTable data={mockPeople} columns={columns} />
    </div>
  );
}
