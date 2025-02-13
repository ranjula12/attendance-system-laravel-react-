import { useState, useEffect } from "react";
import { Table, Modal, Button, Form } from "react-bootstrap";
import axios from "axios";
import { FaMoon, FaSun } from "react-icons/fa";

const RosterTable = () => {
  const [departments, setDepartments] = useState([]);
  const [attendance, setAttendance] = useState([]);
  const [selectedYear, setSelectedYear] = useState(new Date().getFullYear());
  const [selectedMonth, setSelectedMonth] = useState(new Date().getMonth() + 1);
  const [modalShow, setModalShow] = useState(false);
  const [darkMode, setDarkMode] = useState(false);
  const [currentDate, setCurrentDate] = useState(
    new Date().toISOString().split("T")[0] // Set the current date in the correct format (YYYY-MM-DD)
  );
  const [selectedCell, setSelectedCell] = useState(null);
  const [newStatus, setNewStatus] = useState("");

  useEffect(() => {
    const today = new Date().toISOString().split("T")[0];
    setCurrentDate(today);
    fetchDepartments();
    fetchAttendance();
  }, [selectedYear, selectedMonth]);

  const fetchDepartments = async () => {
    try {
      const response = await axios.get(
        "http://dev-attendence.test/api/departments"
      );
      setDepartments(response.data);
    } catch (error) {
      console.error("Error fetching departments:", error);
    }
  };

  const fetchAttendance = async () => {
    try {
      const response = await axios.get(
        `http://dev-attendence.test/api/attendance?year=${selectedYear}&month=${selectedMonth}`
      );
      setAttendance(response.data);
    } catch (error) {
      console.error("Error fetching attendance:", error);
    }
  };

  const handleCellClick = (employeeId, date) => {
    if (date !== currentDate) {
      alert("You can only update attendance for the current date.");
      return;
    }
    setSelectedCell({ employeeId, date });
    setModalShow(true); 
  };

  const updateAttendance = async () => {
    try {
      const response = await axios.post(
        "http://dev-attendence.test/api/attendance/update",
        {
          employee_id: selectedCell.employeeId,
          date: selectedCell.date,
          status: newStatus, // Pass the new status to update
        }
      );
      console.log("Updated Attendance:", response.data);
      fetchAttendance();
      setModalShow(false);
    } catch (error) {
      console.error("Error updating attendance:", error);
    }
  };

  const getStatusColor = (status) => {
    switch (status) {
      case "present":
        return "table-success";
      case "absent":
        return "table-danger";
      case "short leave":
        return "table-warning";
      case "on duty":
        return "table-primary";
      case "sick leave":
        return "table-secondary";
      default:
        return "";
    }
  };

  const getDaysInMonth = () => {
    return new Date(selectedYear, selectedMonth, 0).getDate();
  };

  const toggleDarkMode = () => {
    setDarkMode(!darkMode);
    document.body.classList.toggle("dark-mode", !darkMode); // Toggle dark mode class
  };

  return (
    <div className={`container mt-4 ${darkMode ? "text-white" : "text-dark"}`}>
      <header className="d-flex justify-content-between align-items-center mb-4">
        <h3 className="fw-bold">Attendance System</h3>
        <Button variant="link" className="p-0" onClick={toggleDarkMode}>
          {darkMode ? (
            <FaSun size={24} color="#ffc107" />
          ) : (
            <FaMoon size={24} />
          )}
        </Button>
      </header>
      <div className="d-flex mb-3">
        <Form.Control
          type="number"
          value={selectedYear}
          onChange={(e) => setSelectedYear(e.target.value)}
          onWheel={(e) => e.preventDefault()}
          placeholder="Year"
          className="me-2"
        />
        <Form.Select
          value={selectedMonth}
          onChange={(e) => setSelectedMonth(e.target.value)}
          className="me-2"
        >
          {[...Array(12)].map((_, i) => (
            <option key={i + 1} value={i + 1}>
              {new Date(0, i).toLocaleString("default", { month: "long" })}
            </option>
          ))}
        </Form.Select>
      </div>
      <div
        style={{
          maxWidth: "100%",
          maxHeight: "70vh",
          overflow: "auto",
          border: "1px solid #ccc",
          borderRadius: "8px",
        }}
      >
        <Table striped bordered hover className={darkMode ? "table-dark" : ""}>
          <thead>
            <tr>
              <th>Department</th>
              {[...Array(getDaysInMonth())].map((_, i) => (
                <th key={i + 1}>{i + 1}</th>
              ))}
            </tr>
          </thead>
          <tbody>
            {departments.map((department) => (
              <>
                <tr key={department.id}>
                  <td colSpan={getDaysInMonth() + 1} className="fw-bold">
                    {department.name}
                  </td>
                </tr>
                {department.employees.map((employee) => (
                  <tr key={employee.id}>
                    <td>{employee.name}</td>
                    {[...Array(getDaysInMonth())].map((_, i) => {
                      const date = `${selectedYear}-${String(
                        selectedMonth
                      ).padStart(2, "0")}-${String(i + 1).padStart(2, "0")}`;
                      const attendanceRecord = attendance.find(
                        (att) =>
                          att.employee_id === employee.id && att.date === date
                      );
                      const status = attendanceRecord
                        ? attendanceRecord.status
                        : "N/A";
                      return (
                        <td
                          key={i + 1}
                          className={`text-center ${getStatusColor(status)}`}
                          onClick={() => handleCellClick(employee.id, date)}
                        >
                          {status}
                        </td>
                      );
                    })}
                  </tr>
                ))}
              </>
            ))}
          </tbody>
        </Table>
      </div>

      <Modal show={modalShow} onHide={() => setModalShow(false)}>
        <Modal.Header closeButton>
          <Modal.Title>Update Attendance</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <Form.Select
            onChange={(e) => setNewStatus(e.target.value)}
            defaultValue=""
          >
            <option value="" disabled>
              Select Status
            </option>
            <option value="present">Present</option>
            <option value="absent">Absent</option>
            <option value="short leave">Short Leave</option>
            <option value="on duty">On Duty</option>
            <option value="sick leave">Sick Leave</option>
          </Form.Select>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setModalShow(false)}>
            Cancel
          </Button>
          <Button variant="primary" onClick={updateAttendance}>
            Update
          </Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default RosterTable;
