import { useEffect, useState } from 'react';
import { Person } from '../types/types';
import { format, isWithinInterval, addDays, parseISO } from 'date-fns';
import { Cake } from 'lucide-react';

interface Props {
  people: Person[];
}

export default function WeeklyBirthdays({ people }: Props) {
  const [upcomingBirthdays, setUpcomingBirthdays] = useState<Person[]>([]);

  useEffect(() => {
    const today = new Date();
    const nextWeek = addDays(today, 7);

    const upcoming = people.filter(person => {
      const birthday = parseISO(person.birthday);
      const thisYearBirthday = new Date(
        today.getFullYear(),
        birthday.getMonth(),
        birthday.getDate()
      );

      return isWithinInterval(thisYearBirthday, { start: today, end: nextWeek });
    });

    setUpcomingBirthdays(upcoming);
  }, [people]);

  return (
    <div className="bg-white p-6 rounded-lg shadow-sm">
      <div className="flex items-center mb-4">
        <Cake className="w-5 h-5 mr-2 text-pink-500" />
        <h2 className="text-lg font-semibold">Upcoming Birthdays</h2>
      </div>
      {upcomingBirthdays.length > 0 ? (
        <ul className="space-y-3">
          {upcomingBirthdays.map(person => (
            <li key={person.id} className="flex items-center justify-between">
              <span>{person.firstName} {person.lastName}</span>
              <span className="text-gray-500 text-sm">
                {format(parseISO(person.birthday), 'MMMM d')}
              </span>
            </li>
          ))}
        </ul>
      ) : (
        <p className="text-gray-500">No birthdays in the next 7 days</p>
      )}
    </div>
  );
}
