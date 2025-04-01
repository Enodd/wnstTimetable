import { getRequestUrl } from '@/Helpers/apiHelper';
import { GroupTree } from '@/Models/Group';
import { useQuery } from '@tanstack/react-query';
import { useEffect } from 'react';

export const useGroups = () => {
  const groupTreeData = useQuery<GroupTree[], Error>({
    queryKey: ['group_tree'],
    queryFn: async () => {
      const res = await fetch(getRequestUrl('group_tree'));
      const parsed = await res.json();
      console.log(parsed);
      return parsed;
    } 
  });
  useEffect(() => {
    if (groupTreeData.data?.length == 0) {
      groupTreeData.refetch();
    }
    console.log(groupTreeData.data);
  });
  return groupTreeData; 
};