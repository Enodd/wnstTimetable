import DefaultLayout from '@/Layouts/DefaultLayout';
import React from 'react';

const Welcome: React.FC<{ mainPageContent: string }> = ({ mainPageContent }) => {

  return (
    <DefaultLayout>
      <div
        className='landingPage__container'
        dangerouslySetInnerHTML={{ __html: mainPageContent }}
      />
    </DefaultLayout>
  );
};

export default Welcome;
