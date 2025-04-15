import { getRequestUrl } from '@/Helpers/apiHelper';
import { Conductors } from '@/Models/Conductor';
import { useQuery } from '@tanstack/react-query';
import { useEffect } from 'react';

export const useConductors = () => {
  const conductorsTreeData = useQuery<Conductors[], Error>({
    queryKey: ['conductors_tree'],
    queryFn: async () => {
      const res = await fetch(getRequestUrl('conductors_tree'));
      const parsed = await res.json();
      return parsed;
    }
  });

  useEffect(() => {
    if (conductorsTreeData.data?.length === 0) {
      conductorsTreeData.refetch();
    }
    console.log(conductorsTreeData.data);
  });

  return conductorsTreeData;
};
