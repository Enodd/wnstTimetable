import React, { useEffect, useState } from 'react';
import DefaultLayout from '@/Layouts/DefaultLayout';

const Welcome: React.FC = () => {
  const [content, setContent] = useState<string>('');
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
  },[]);
  return (
    <DefaultLayout>
      <div className='grid grid-cols-2 gap-2'
        dangerouslySetInnerHTML={{ __html: content }} />
    </DefaultLayout>
  );
};

export default Welcome;