import { getRequestUrl } from '@/Helpers/apiHelper';
import { useQuery } from '@tanstack/react-query';
import { useEffect } from 'react';
import { Rooms } from '@/Models/Room.ts';

export const useRooms = () => {

  const roomsTreeData = useQuery<Rooms[], Error>({
    queryKey: ['rooms_tree'],
    queryFn: async () => {
      const res = await fetch(getRequestUrl('rooms'));
      return await res.json();
    }
  });

  useEffect(() => {
    if (roomsTreeData.data?.length === 0) {
      roomsTreeData.refetch();
    }
  });

  return roomsTreeData;
};
