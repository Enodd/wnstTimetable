import { SidebarLink } from '@/Components/SidebarLink';
import { useSidebarProvider } from '@/Hooks/useSidebarProvider';
import { Conductor, Conductors } from '@/Models/Conductor';
import { hoverBarAnimation } from '@/Theme/hoverBarAnimation';
import { Accordion,
  AccordionDetails,
  AccordionSummary,
  Stack,
  Typography } from '@mui/material';
import React, { useState } from 'react';
import { MdArrowDropDown, MdArrowDropUp } from 'react-icons/md';

const ConductorDisplay: React.FC<{ conductor: Conductor }> = ({ conductor }) => {
  return (
    <SidebarLink href='x'>
      {`${conductor.surname} ${conductor.name}`}
    </SidebarLink>
  );
};

const ConductorsDisplay: React.FC<{ conductors: Conductors }> = ({ conductors }) => {
  const [isExpanded, setIsExpanded] = useState<boolean>(false);

  const handleTabExpand = (e: React.SyntheticEvent) => {
    e.currentTarget.parentElement?.scrollIntoView({
      behavior: 'smooth',
      block: 'start',
    });
    setIsExpanded((prev) => !prev);
  };

  return (
    <Accordion
      expanded={isExpanded}
      variant='outlined'
      onChange={handleTabExpand}
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
            sx={(theme) => ({ ...hoverBarAnimation(theme.palette.primary.contrastText) })}
            target='_blank'
            width='fit-content'
          >
            {conductors.name}
          </Typography>
          {isExpanded ? (
            <MdArrowDropUp fontSize={'32px'} />
          ) : (
            <MdArrowDropDown fontSize={'32px'} />
          )}
        </Stack>
      </AccordionSummary>
      <AccordionDetails>
        <Stack gap={1}>
          {conductors.children.length > 0 ? (
            conductors.children.map((el) => (
              <ConductorsDisplay
                conductors={el}
                key={conductors.name} />
            ))
          ) : conductors.conductors.length > 0 ? (
            conductors.conductors.map((cond) => (
              <ConductorDisplay
                conductor={cond}
                key={`${cond.name}-${cond.surname}`}
              />
            ))
          ) : (
            <></>
          )}
        </Stack>
      </AccordionDetails>
    </Accordion>
  );
};

export const ConductorsTabView: React.FC = () => {
  const { conductors } = useSidebarProvider();
  return (
    <>
      {conductors.length > 0 ? (
        conductors.map((conductor) => (
          <ConductorsDisplay
            conductors={conductor}
            key={`top-${conductor.name}`}
          />
        ))
      ) : (
        <></>
      )}
    </>
  );
};
