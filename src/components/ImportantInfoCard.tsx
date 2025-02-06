import { ImportantInfo } from '../types/types';
import { format, isPast } from 'date-fns';
import { AlertCircle } from 'lucide-react';

interface Props {
  info: ImportantInfo;
}

export default function ImportantInfoCard({ info }: Props) {
  const priorityColors = {
    low: 'bg-blue-100 text-blue-800',
    medium: 'bg-yellow-100 text-yellow-800',
    high: 'bg-red-100 text-red-800'
  };

  const isOverdue = isPast(new Date(info.dueDate));

  return (
    <div className="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
      <div className="flex items-center justify-between mb-2">
        <h3 className="font-semibold">{info.title}</h3>
        <span className={`px-2 py-1 rounded-full text-xs ${priorityColors[info.priority]}`}>
          {info.priority}
        </span>
      </div>
      <p className="text-gray-600 text-sm mb-2">{info.description}</p>
      <div className="flex items-center text-sm">
        {isOverdue && <AlertCircle className="w-4 h-4 text-red-500 mr-1" />}
        <span className={isOverdue ? 'text-red-500' : 'text-gray-500'}>
          Due: {format(new Date(info.dueDate), 'MMM d, yyyy')}
        </span>
      </div>
    </div>
  );
}
