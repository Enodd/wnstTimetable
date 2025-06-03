import {
  Button,
  Checkbox,
  FormControlLabel,
  FormGroup,
  Stack,
  TextField,
  Typography,
  useTheme
} from '@mui/material';
import React, { useState } from 'react';

enum SearchParams {
  Rooms,
  Groups,
  Conductors
}

export const SearchBar: React.FC = () => {
  const { palette } = useTheme();
  const [searchQuote, setSearchQuote] = useState<string>('');
  const [searchParams, setSearchParams] = useState<{
    [key: number]: boolean;
  }>({
    [SearchParams.Rooms]: true,
    [SearchParams.Conductors]: true,
    [SearchParams.Groups]: true,
  });

  const handleSearchParamsUpdate = (paramName: SearchParams) => {
    setSearchParams((prev) => ({
      ...prev,
      [paramName]: !prev[paramName].valueOf(),
    }));
  };

  const handleInputBlur = (
    e: React.FocusEvent<HTMLInputElement | HTMLTextAreaElement, Element>
  ) => {
    setSearchQuote(e.target.value);
  };

  const handleSearchButton = () => {
    let query = `/search?q=${searchQuote}`;
    if (!searchParams[SearchParams.Conductors]) {
      query += `&conductors=${searchParams[SearchParams.Conductors]}`;
    }
    if (!searchParams[SearchParams.Groups]) {
      query += `&groups=${searchParams[SearchParams.Groups]}`;
    }
    if (!searchParams[SearchParams.Rooms]) {
      query += `&rooms=${searchParams[SearchParams.Rooms]}`;
    }
    window.location.href = query;
  };

  return (
    <Stack
      alignItems={'center'}
      borderRadius={3}
      flexBasis={1}
      gap={2}
      mb={1}
      p={2}
      sx={{ background: palette.info.main }}
    >
      <Typography variant='h3'>Szukaj planu</Typography>
      <TextField
        fullWidth
        color='primary'
        label={'Szukaj'}
        onBlur={handleInputBlur}
      />
      <FormGroup>
        <Stack direction={'row'}>
          <FormControlLabel
            label={'Sale'}
            control={<Checkbox
              checked={searchParams[SearchParams.Rooms]}
              onChange={() => handleSearchParamsUpdate(SearchParams.Rooms)}
            />}
          />
          <FormControlLabel
            label={'Nauczyciele'}
            control={
              <Checkbox
                checked={searchParams[SearchParams.Conductors]} 
                onChange={() => handleSearchParamsUpdate(SearchParams.Conductors)}
              />
            }
          />
          <FormControlLabel
            label={'Grupy'}
            control={<Checkbox
              checked={searchParams[SearchParams.Groups]}
              onChange={() => handleSearchParamsUpdate(SearchParams.Groups)}
            />}
          />
        </Stack>
      </FormGroup>
      <Button
        fullWidth
        color='primary'
        sx={{ maxWidth: '350px' }}
        variant='contained'
        onClick={handleSearchButton}
      >
        Szukaj
      </Button>
    </Stack>
  );
};
