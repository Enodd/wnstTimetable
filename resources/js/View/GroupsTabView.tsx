/* eslint-disable react/jsx-key */
import { SidebarLink } from '@/Components/SidebarLink';
import { useSidebarProvider } from '@/Hooks/useSidebarProvider';
import { GroupTree } from '@/Models/Group';
import { Accordion,
  AccordionDetails,
  AccordionSummary,
  Stack,
  Typography } from '@mui/material';
import React, { useState } from 'react';
import { MdArrowDropDown, MdArrowDropUp } from 'react-icons/md';

const GroupDisplay: React.FC<{ group: GroupTree }> = ({ group }) => {
  const [isExpanded, setIsExpanded] = useState<boolean>(false);
  if (group.subGroups.length === 0) {
    return <SidebarLink href='x'>{group.name}</SidebarLink>;
  }

  return (
    <Accordion
      expanded={isExpanded}
      variant='outlined'
      onChange={() => setIsExpanded((prev) => !prev)}
    >
      <AccordionSummary
        sx={(theme) => ({
          color: theme.palette.primary.dark,
          fontWeight: 'bold',
          '&.Mui-expanded': { margin: 0 },
        })}
      >
        <Stack
          alignItems={'center'}
          direction={'row'}
          justifyContent={'space-between'}
          width={'100%'}
        >
          <Typography
            component={'a'}
            href={'https://google.com'}
            sx={{ textDecoration: 'underline' }}
            target='_blank'
            width='fit-content'
          >
            {group.name}
          </Typography>
          {isExpanded ? (
            <MdArrowDropUp fontSize={'32px'} />
          ) : (
            <MdArrowDropDown fontSize={'32px'} />
          )}
        </Stack>
      </AccordionSummary>
      <AccordionDetails>
        <Stack
          gap={1}
          height={'fit-content'}>
          {group.subGroups.map((el) => (
            <GroupDisplay group={el} />
          ))}
        </Stack>
      </AccordionDetails>
    </Accordion>
  );
};

export const GroupsTabView: React.FC = () => {
  const { groups } = useSidebarProvider();
  return (
    <>
      {groups?.length > 0 ? (
        groups?.map((group) => <GroupDisplay group={group} />)
      ) : (
        <></>
      )}
    </>
  );
};
