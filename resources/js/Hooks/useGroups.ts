import { getRequestUrl } from '@/Helpers/apiHelper';
import { Group } from '@/Models/Group';
import { useQuery } from '@tanstack/react-query';

export const useGroups = () => {
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  const { data } = useQuery<Group[], Error>({
    queryKey: ['groups'],
    queryFn: () => fetch(getRequestUrl('groups')).then((res)=> res.json())
  });
};