import React from 'react';
import DefaultLayout from '@/Layouts/DefaultLayout';
import { Button, Stack, Typography, useTheme } from '@mui/material';

const Welcome: React.FC = () => {
  const theme = useTheme();
  return (
    <DefaultLayout>
      <Stack
        gap={2}
        height={'calc(100vh - ' + theme.spacing(6) + ')'}>
        <Typography variant='h1'>Hellow</Typography>
        <Button
          color='primary'
          variant='contained'>
          button contained
        </Button>
        <Button
          color='secondary'
          variant='contained'>
          button contained
        </Button>
        <Button
          color='primary'
          variant='outlined'>
          button contained
        </Button>
        <Button
          color='secondary'
          variant='outlined'>
          button contained
        </Button>
        <Typography variant='h4'>Howdy</Typography>
      </Stack>
    </DefaultLayout>
  );
};

export default Welcome;