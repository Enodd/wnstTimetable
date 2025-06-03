import {
  Box,
  lighten,
  Link,
  List,
  ListItem,
  Pagination,
  Stack,
  Typography,
  useTheme
} from '@mui/material';
import React, { useEffect } from 'react';

const SearchResults: React.FC<{
  query: string;
  searchResults: Array<{ name: string; href: string }>;
  totalPages: number;
  page: number;
}> = ({ query, searchResults, page, totalPages }) => {
  const { palette } = useTheme();

  useEffect(() => {
    if (page > totalPages && totalPages > 0) {
      window.location.replace(`/search?q=${query}`);
    }
  });

  const handleChange = (newPage: number) => {
    let newQuery = `/search?q=${query}`;
    if (totalPages > 1) {
      newQuery += `&p=${newPage}`;
    }
    window.location.href = newQuery;
  };

  return (
    <>
      <Stack
        alignItems={'center'}
        bgcolor={lighten(palette.background.default, 0.1)}
        borderRadius={3}
        flexGrow={1}
        justifyContent={'space-between'}
        p={2}
      >
        <Box width={'100%'}>
          <Typography
            textAlign={'center'}
            variant='h4'>
            Wyniki
          </Typography>
          <List>
            {searchResults.map((result) => {
              return (
                <ListItem
                  key={result.name}
                >
                  <Link
                    href={result.href}>
                    {result.name}
                  </Link>
                </ListItem>
              );
            })}
          </List>
        </Box>
        <Pagination
          color='primary'
          count={totalPages}
          page={page}
          onChange={(_, newPage) => handleChange(newPage)}
        />
      </Stack>
    </>
  );
};

export default SearchResults;
