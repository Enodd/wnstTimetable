import DefaultLayout from '@/Layouts/DefaultLayout';
import React from 'react';

const LandingPage: React.FC<{ mainPageContent: string }> = ({ mainPageContent }) => {
  return (
    <DefaultLayout>
      <div
        className='landingPage__container'
        dangerouslySetInnerHTML={{ __html: mainPageContent }}
      />
    </DefaultLayout>
  );
};

export default LandingPage;
