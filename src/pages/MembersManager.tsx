import { useState } from 'react';
import DataTable from '../components/DataTable';
import { Member } from '../types/types';
import { mockMembers } from '../utils/mockData';
import { format } from 'date-fns';

export default function MembersManager() {
  const [members, setMembers] = useState<Member[]>(mockMembers);
  const [selectedMember, setSelectedMember] = useState<Member | null>(null);
  const [isModalOpen, setIsModalOpen] = useState(false);

  const columns = [
    {
      header: 'Name',
      accessorFn: (row: Member) => `${row.firstName} ${row.lastName}`,
    },
    {
      header: 'Region',
      accessorKey: 'region',
    },
    {
      header: 'Family Group',
      accessorKey: 'familyGroup',
    },
    {
      header: 'Health Status',
      accessorKey: 'healthStatus',
      cell: (info: any) => (
        <span
          className={`px-2 py-1 rounded-full text-xs ${
            info.getValue() === 'sick'
              ? 'bg-red-100 text-red-800'
              : 'bg-green-100 text-green-800'
          }`}
        >
          {info.getValue()}
        </span>
      ),
    },
    {
      header: 'Birthday',
      accessorKey: 'birthday',
      cell: (info: any) => format(new Date(info.getValue()), 'MMM d, yyyy'),
    },
    {
      header: 'Actions',
      cell: (info: any) => (
        <div className="space-x-2">
          <button
            onClick={() => handleEdit(info.row.original)}
            className="px-3 py-1 text-xs text-blue-600 hover:text-blue-800"
          >
            Edit
          </button>
          <button
            onClick={() => handleDelete(info.row.original.id)}
            className="px-3 py-1 text-xs text-red-600 hover:text-red-800"
          >
            Delete
          </button>
        </div>
      ),
    },
  ];

  const handleEdit = (member: Member) => {
    setSelectedMember(member);
    setIsModalOpen(true);
  };

  const handleDelete = (id: string) => {
    if (window.confirm('Are you sure you want to delete this member?')) {
      setMembers(members.filter(member => member.id !== id));
    }
  };

  return (
    <div className="p-6">
      <div className="flex justify-between items-center mb-6">
        <h1 className="text-2xl font-bold text-gray-800">Members Manager</h1>
        <button
          onClick={() => {
            setSelectedMember(null);
            setIsModalOpen(true);
          }}
          className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
        >
          Add Member
        </button>
      </div>

      <DataTable data={members} columns={columns} />

      {/* Modal would go here - implemented separately */}
    </div>
  );
}
