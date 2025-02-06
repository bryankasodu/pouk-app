import { useMemo } from 'react';
import DataTable from '../components/DataTable';
import { mockImportantInfo } from '../utils/mockData';
import { format } from 'date-fns';

export default function ImportantInfo() {
  const columns = useMemo(
    () => [
      {
        header: 'Title',
        accessorKey: 'title',
      },
      {
        header: 'Description',
        accessorKey: 'description',
      },
      {
        header: 'Due Date',
        accessorKey: 'dueDate',
        cell: (info: any) => format(new Date(info.getValue()), 'MMM d, yyyy'),
      },
      {
        header: 'Priority',
        accessorKey: 'priority',
        cell: (info: any) => (
          <span
            className={`px-2 py-1 rounded-full text-xs ${
              info.getValue() === 'high'
                ? 'bg-red-100 text-red-800'
                : info.getValue() === 'medium'
                ? 'bg-yellow-100 text-yellow-800'
                : 'bg-blue-100 text-blue-800'
            }`}
          >
            {info.getValue()}
          </span>
        ),
      },
    ],
    []
  );

  return (
    <div className="p-6">
      <h1 className="text-2xl font-bold text-gray-800 mb-6">Important Information</h1>
      <DataTable data={mockImportantInfo} columns={columns} />
    </div>
  );
}
