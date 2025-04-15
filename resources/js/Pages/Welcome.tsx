import React, { useEffect, useState } from 'react';
import DefaultLayout from '@/Layouts/DefaultLayout';
import { useQuery } from '@tanstack/react-query';
import { getRequestUrl } from '@/Helpers/apiHelper';

const Welcome: React.FC = () => {
  const [content, setContent] = useState<string>('');

  const conductorsTreeData = useQuery<any[], Error>({
    queryKey: ['conductors_tree'],
    queryFn: async () => {
      const res = await fetch(getRequestUrl('conductors_tree'));
      const parsed = await res.json();
      return parsed;
    }
  });

  const getContent = async () => {
    try {
      const data = await fetch('http://localhost:8000/api/landingPage');
      setContent(await data.text());
    } catch (err) {
      console.error(err);
      setContent('<p>Error occured</p>');
    }
  };

  useEffect(() => {
    getContent();
  }, []);

  useEffect(() => {
    if (conductorsTreeData.data?.length === 0) {
      conductorsTreeData.refetch();
    } else {
      console.log(conductorsTreeData.data);
    }
  });
  return (
    <DefaultLayout>
      <div
        className='flex flex-col gap-2 justify-center h-screen'
        dangerouslySetInnerHTML={{ __html: content }} />
    </DefaultLayout>
  );
};

export default Welcome;
