import { SearchBar } from '@/Components/SearchBar';
import React from 'react';

const LandingPage: React.FC<{ mainPageContent: string }> = ({ mainPageContent }) => {
  return (
    <>
      <SearchBar />
      <div
        className='landingPage__container'
        dangerouslySetInnerHTML={{ __html: mainPageContent }}
      />
    </>
  );
};

export default LandingPage;
