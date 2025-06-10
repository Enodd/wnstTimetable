import { TimetableData } from '@/Models/TimetableData';
import { Box } from '@mui/material';
import React from 'react';

const Timetable: React.FC<{ data: TimetableData[] }> = (props) => {


  return <Box>
    {props.data.map(i => {
      return <p key={i.name}>
        {i.name}
      </p>;
    })}
  </Box>;
};

export default Timetable;