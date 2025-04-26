import SidebarTab from "@/Layouts/Components/SidebarTab";
import SidebarTabs from "@/Models/SidebarTabs";
import { ConductorsTabView } from "@/View/ConductorsTabView";
import { GroupsTabView } from "@/View/GroupsTabView";
import {
  Box,
  Drawer,
  Stack,
  Tab,
  Tabs,
  Typography,
  useMediaQuery,
  useTheme,
} from "@mui/material";
import dayjs from "dayjs";
import React, { useState } from "react";

interface SidebarProps {
  open: boolean;
  onClose: () => void;
}

const Sidebar: React.FC<SidebarProps> = ({ open, onClose }) => {
  const theme = useTheme();
  const isMdUp = useMediaQuery(theme.breakpoints.up("md"));
  const [activeTab, setActiveTab] = useState<SidebarTabs>(SidebarTabs.Groups);

  const tabStyles = {
    fontWeight: "bold",
    color: "#c1c1c1",
    "&.Mui-selected": { color: theme.palette.primary.contrastText },
  };

  const handleTabChange = (_event: React.SyntheticEvent, value: number) => {
    setActiveTab(value);
  };

  return (
    <Drawer
      open={true}
      variant={isMdUp ? "persistent" : "temporary"}
      sx={{
        "& .MuiDrawer-paper": {
          ...theme.drawer.styles,
          marginRight: 0,
          maxWidth: "350px",
          height: "100vh",
          paddingY: theme.spacing(4),
        },
      }}
      onClose={onClose}
    >
      <Stack
        alignItems={"center"}
        flexBasis={"fit-content"}
        height={"100%"}
        justifyContent={"space-between"}
      >
        <Stack alignItems={"center"} gap={0.5}>
          <Typography textAlign={"center"} variant="h1">
            Wydział nauk ścisłych i&nbsp;technicznych
          </Typography>
          <Typography variant="h2">Uniwersytet Śląski</Typography>
          <Typography variant="h3">semestr letni 2024/2025</Typography>
          <Typography fontWeight={"bold"} variant="body1">
            {dayjs().format("DD.MM.YYYY")}
          </Typography>
        </Stack>
        <Stack direction={"row"} flexBasis={"fit-content"}>
          <Tabs
            indicatorColor="secondary"
            value={activeTab}
            onChange={handleTabChange}
          >
            <Tab label="Grupy" sx={tabStyles} value={SidebarTabs.Groups} />
            <Tab
              label={"Nauczyciele"}
              sx={tabStyles}
              value={SidebarTabs.Teachers}
            />
            <Tab label="Sale" sx={tabStyles} value={SidebarTabs.Classes} />
          </Tabs>
        </Stack>
        <Box height={"65vh"} overflow={"scroll"} paddingX={2}>
          <SidebarTab
            currentTab={activeTab}
            value={SidebarTabs.Classes}
            view={<></>}
          />
          <SidebarTab
            currentTab={activeTab}
            value={SidebarTabs.Teachers}
            view={<ConductorsTabView />}
          />
          <SidebarTab
            currentTab={activeTab}
            value={SidebarTabs.Groups}
            view={<GroupsTabView />}
          />
        </Box>
        <Stack alignItems={"center"} flexBasis={"fit-content"}>
          <Typography>Obsługa rezerwacji</Typography>
          <Typography>Info</Typography>
          <Typography>Pomoc</Typography>
          <Typography>Zaloguj się</Typography>
          <Typography mt={4} textAlign={"center"}>
            Ostatnia aktualizacja bazy: <br /> {new Date().toLocaleDateString()}
          </Typography>
        </Stack>
      </Stack>
    </Drawer>
  );
};

export default Sidebar;
